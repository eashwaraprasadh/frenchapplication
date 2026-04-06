<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentDailyStatus;
use App\Models\StudentDailyTopic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminStatusController extends Controller
{
    public function index()
    {
        // Get students who have logged status recently
        $students = User::where('role', 'student')
            ->whereHas('dailyStatuses')
            ->with([
                'dailyStatuses' => function ($query) {
                    $query->latest('log_date')->take(1);
                }
            ])
            ->get()
            ->map(function ($student) {
                $student->last_update = $student->dailyStatuses->first()?->created_at;
                return $student;
            })
            ->sortByDesc('last_update');

        return view('admin.status.index', compact('students'));
    }

    public function show(Request $request, User $student)
    {
        $date = $request->has('month') ? Carbon::parse($request->month) : now();
        $startOfMonth = $date->copy()->startOfMonth();
        $endOfMonth = $date->copy()->endOfMonth();

        // Get statuses for this student
        $statuses = StudentDailyStatus::with('topics')
            ->where('user_id', $student->id)
            ->whereBetween('log_date', [$startOfMonth, $endOfMonth])
            ->get()
            ->keyBy(function ($item) {
                return $item->log_date->format('Y-m-d');
            });

        // Generate calendar days
        $days = [];
        $current = $startOfMonth->copy();
        while ($current <= $endOfMonth) {
            $days[] = [
                'date' => $current->copy(),
                'status' => $statuses->get($current->format('Y-m-d'))
            ];
            $current->addDay();
        }

        return view('admin.status.show', compact('student', 'days', 'date'));
    }

    public function storeTopic(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'date' => 'required|date'
        ]);

        $status = StudentDailyStatus::firstOrCreate(
            [
                'user_id' => $request->student_id,
                'log_date' => $request->date,
            ]
        );

        $topic = $status->topics()->create([
            'topic' => '',
            'starting_time' => '',
            'ending_time' => '',
            'duration' => ''
        ]);

        return response()->json([
            'success' => true,
            'topic' => $topic
        ]);
    }

    public function updateTopic(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:student_daily_topics,id',
            'field' => 'required|in:topic,starting_time,ending_time,duration',
            'value' => 'nullable|string'
        ]);

        $topic = StudentDailyTopic::find($request->topic_id);
        $topic->update([
            $request->field => $request->value
        ]);

        return response()->json(['success' => true]);
    }

    public function deleteTopic(Request $request)
    {
        $request->validate([
            'topic_id' => 'required|exists:student_daily_topics,id',
        ]);

        $topic = StudentDailyTopic::find($request->topic_id);
        $topic->delete();

        return response()->json(['success' => true]);
    }
}
