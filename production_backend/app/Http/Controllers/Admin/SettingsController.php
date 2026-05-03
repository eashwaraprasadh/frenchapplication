<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function index()
    {
        // Load settings
        $settings = Setting::all()->pluck('value', 'key');

        // Check System Health
        $systemHealth = [
            'database' => $this->checkDatabaseHealth(),
            'storage' => $this->checkStorageHealth(),
            'cache' => $this->checkCacheHealth(),
            'mail' => ['status' => 'warning', 'message' => 'Not configured'] // Consistent with request
        ];

        return view('admin.settings.index', compact('settings', 'systemHealth'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function clearCache()
    {
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');

        return redirect()->back()->with('success', 'System cache cleared successfully.');
    }

    private function checkDatabaseHealth()
    {
        try {
            DB::connection()->getPdo();
            return ['status' => 'healthy', 'message' => 'Connected'];
        } catch (\Exception $e) {
            return ['status' => 'error', 'message' => 'Connection failed'];
        }
    }

    private function checkStorageHealth()
    {
        $storagePath = storage_path('app');
        if (is_writable($storagePath)) {
            return ['status' => 'healthy', 'message' => 'Writable'];
        }
        return ['status' => 'warning', 'message' => 'Permission issues'];
    }

    private function checkCacheHealth()
    {
        try {
            Cache::put('health_check', 'ok', 60);
            $value = Cache::get('health_check');
            return ['status' => 'healthy', 'message' => 'Working'];
        } catch (\Exception $e) {
            return ['status' => 'warning', 'message' => 'Issues detected'];
        }
    }
}
