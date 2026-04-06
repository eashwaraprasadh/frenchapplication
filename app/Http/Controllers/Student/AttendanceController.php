<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\StudentAttendance;

use App\Models\AttendanceSession;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $today = Carbon::today()->format('Y-m-d');
        
        $todaySessions = AttendanceSession::whereDate('date', $today)->orderBy('start_time')->get();
        // Get attendance IDs the user has already marked for today
        $markedSessionIds = $user->attendances()
            ->whereNotNull('attendance_session_id')
            ->whereDate('date', $today)
            ->pluck('attendance_session_id')
            ->toArray();
            
        $attendances = $user->attendances()->with('session')->orderBy('date', 'desc')->paginate(10);
        
        return view('student.attendance.index', compact('todaySessions', 'markedSessionIds', 'attendances', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:present,absent',
            'session_id' => 'required|exists:attendance_sessions,id'
        ]);

        $user = auth()->user();
        $today = Carbon::today()->format('Y-m-d');
        
        $session = AttendanceSession::find($request->session_id);

        $now = Carbon::now();
        $sessionEnd = Carbon::parse($session->date->format('Y-m-d') . ' ' . $session->end_time);

        if ($now->lt($sessionEnd)) {
            return back()->with('error', 'Attendance can only be marked after the session scheduled time (' . $sessionEnd->format('h:i A') . ').');
        }

        if (\Carbon\Carbon::parse($session->date)->format('Y-m-d') !== $today) {
            return back()->with('error', 'You can only mark attendance for today\'s sessions.');
        }

        $existing = $user->attendances()->where('attendance_session_id', $session->id)->first();
        if ($existing) {
            return back()->with('error', 'Attendance for this session is already marked.');
        }

        $user->attendances()->create([
            'attendance_session_id' => $session->id,
            'date' => $today, // keeping date for backward compatibility / easy filtering
            'status' => $request->status,
            'approval_status' => 'pending'
        ]);

        return back()->with('success', 'Attendance marked successfully and is pending approval.');
    }
}
