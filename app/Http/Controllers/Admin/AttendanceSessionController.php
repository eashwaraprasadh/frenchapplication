<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttendanceSession;
use Carbon\Carbon;

class AttendanceSessionController extends Controller
{
    public function index(Request $request)
    {
        $sessions = AttendanceSession::orderBy('date', 'desc')->orderBy('start_time', 'asc')->paginate(20);
        return view('admin.attendance.sessions.index', compact('sessions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:attendance_sessions,title',
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ]);

        AttendanceSession::create($request->all());

        return back()->with('success', 'Attendance Session created successfully.');
    }

    public function destroy($id)
    {
        $session = AttendanceSession::findOrFail($id);
        $session->delete();
        return back()->with('success', 'Attendance Session deleted successfully.');
    }
}
