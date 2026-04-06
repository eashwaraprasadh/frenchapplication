<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\StudentAttendance;
use App\Models\AttendanceSession;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $sessionId = $request->get('session_id');
        
        // If filtering by session, use that session's date automatically
        if ($sessionId) {
            $selectedSession = AttendanceSession::find($sessionId);
            $date = $selectedSession ? $selectedSession->date->format('Y-m-d') : Carbon::today()->format('Y-m-d');
        } else {
            $date = $request->get('date', Carbon::today()->format('Y-m-d'));
        }

        $query = StudentAttendance::with(['user', 'session']);

        if ($sessionId) {
            $query->where('attendance_session_id', $sessionId);
        } else {
            $query->whereDate('date', $date);
        }

        $attendances = $query->orderBy('date', 'desc')->get();
        $sessions = AttendanceSession::whereDate('date', $date)->orderBy('start_time')->get();

        // Find the selected session title for display (safe lookup)
        $selectedSessionTitle = null;
        if ($sessionId && $sessions->where('id', $sessionId)->first()) {
            $selectedSessionTitle = $sessions->where('id', $sessionId)->first()->title;
        } elseif ($sessionId && isset($selectedSession)) {
            $selectedSessionTitle = $selectedSession->title ?? 'Session';
        }

        return view('admin.attendance.index', compact('attendances', 'date', 'sessions', 'sessionId', 'selectedSessionTitle'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'approval_status' => 'required|in:pending,approved,rejected'
        ]);

        $attendance = StudentAttendance::findOrFail($id);
        $attendance->approval_status = $request->approval_status;
        $attendance->save();

        return back()->with('success', 'Attendance status updated successfully.');
    }

    public function bulkApprove(Request $request)
    {
        $request->validate([
            'attendance_ids' => 'required|array',
            'attendance_ids.*' => 'exists:student_attendances,id'
        ]);

        StudentAttendance::whereIn('id', $request->attendance_ids)->update(['approval_status' => 'approved']);

        return back()->with('success', 'Selected attendance records have been approved.');
    }
}
