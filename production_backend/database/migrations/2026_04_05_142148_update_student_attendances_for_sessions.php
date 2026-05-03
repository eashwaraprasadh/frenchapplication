<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add column safely
        if (!Schema::hasColumn('student_attendances', 'attendance_session_id')) {
            Schema::table('student_attendances', function (Blueprint $table) {
                $table->foreignId('attendance_session_id')->nullable()->constrained()->onDelete('cascade');
            });

            // 2. Create a default session for legacy records if they exist
            $legacyDates = DB::table('student_attendances')->select('date')->distinct()->pluck('date');
            foreach($legacyDates as $date) {
                // Only create if session for this date doesn't exist
                $session_id = DB::table('attendance_sessions')->updateOrInsert(
                    ['title' => 'Legacy Daily Session', 'date' => $date],
                    ['start_time' => '09:00:00', 'end_time' => '17:00:00', 'created_at' => now(), 'updated_at' => now()]
                );
                
                $session = DB::table('attendance_sessions')->where('date', $date)->where('title', 'Legacy Daily Session')->first();
                if ($session) {
                    DB::table('student_attendances')->where('date', $date)->update(['attendance_session_id' => $session->id]);
                }
            }
        }

        // 3. Drop/Add Index safely
        Schema::table('student_attendances', function (Blueprint $table) {
            $driver = DB::connection()->getDriverName();
            if ($driver !== 'sqlite') {
                // MySQL requires a replacement index before dropping one used by a Foreign Key
                // Also check if index exists first
                $indices = DB::select("SHOW INDEX FROM student_attendances WHERE Key_name = 'student_attendances_user_id_date_unique'");
                if (count($indices) > 0) {
                    // Create a temporary index so the foreign key on user_id doesn't block the drop
                    $table->index('user_id', 'temp_user_id_index');
                    $table->dropUnique(['user_id', 'date']);
                }
            }

            // Check if new unique exists before adding
            $newIndexName = 'student_attendances_user_id_attendance_session_id_unique';
            if ($driver === 'sqlite') {
                 // SQLite check is harder via SQL, but Laravel handles it or we skip if it fails
                 try { $table->unique(['user_id', 'attendance_session_id']); } catch (\Exception $e) {}
            } else {
                $newIndex = DB::select("SHOW INDEX FROM student_attendances WHERE Key_name = '$newIndexName'");
                if (count($newIndex) === 0) {
                    $table->unique(['user_id', 'attendance_session_id']);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_attendances', function (Blueprint $table) {
            if (DB::connection()->getDriverName() !== 'sqlite') {
                $table->dropUnique(['user_id', 'attendance_session_id']);
            }
            $table->dropForeign(['attendance_session_id']);
            $table->dropColumn('attendance_session_id');
        });
    }
};
