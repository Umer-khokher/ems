<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance; // Assuming you have an Attendance model
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function showCheckInForm()
    {
        $user = auth()->user(); // Assuming you have authentication set up
        $currentDate = Carbon::now()->toDateString();

        // Check if the user has an attendance record for the current date
        $attendance = Attendance::where('user_id', $user->id)
                                ->where('date', $currentDate)
                                ->first();

        return view('check_in_attendance', ['attendance' => $attendance]);
    }

    public function checkInAttendance(Request $request)
{
    $now = Carbon::now();
    $currentTime = $now->toTimeString();
    $user = $request->user();
    $attendance = Attendance::where('user_id', $user->id)
                ->whereDate('created_at', now()->toDateString())
                ->first();
    if ($attendance) {
        return response()->json(['message' => 'You have already checked in today.']);
    }
    $status = $this->determineAttendanceStatus($currentTime);
    $userip = request()->ip();
    // echo $userip;
    // die;
    // if($userip == '127.0.0.1'){
            Attendance::create([
                'user_id' => $user->id,
                'status' => $status,
        ]);
        return redirect()->back()->with('success', 'Attendance check-in successful!');
    // }else{
    //     return redirect()->back()->with('error', 'get in the first to check in');
    // }
}
    private function determineAttendanceStatus($checkInTime)
    {
        // Convert the check-in time to a Carbon instance for comparison
        $checkInTime = Carbon::parse($checkInTime);

        // Define the time ranges for "present" and "late" status
        $presentStart = Carbon::parse('09:00:00');
        $presentEnd = Carbon::parse('10:30:00');
        $lateStart = Carbon::parse('10:30:01');

        // Determine the status based on the check-in time
        if ($checkInTime->between($presentStart, $presentEnd)) {
            return 'present';
        } elseif ($checkInTime->gt($lateStart)) {
            return 'late';
        } else {
            return 'absent';
        }
    }
    // Method to display the attendance form
    public function showForm(Request $request)
    {
        
        $user = $request->user();
        $attendanceHistory = Attendance::where('user_id', $user->id)->orderBy('id', 'asc')->get();
        $viewData = array(
            'pageName' => 'Datatable',
            
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => route('admin.dashboard')
                ),
                (object)array(
                    'name' => 'Datatable',
                    'class' => 'active',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
        return view('user.datatable', ['attendanceHistory' => $attendanceHistory])->with($viewData);
    }

    // Method to handle marking attendance
    public function markAttendance(Request $request)
    {
        $status = $request->input('status'); // Assuming you have an input field named 'status' in your attendance form
        $user = auth()->user(); // Get the currently logged-in user
        $userip = request()->ip();
        if($userip == '192.168.18.54'){
        // Save the attendance record in the database
        $attendance = new Attendance([
            'user_id' => $user->id,
            'status' => $status,
        ]);
        $attendance->save();
        return redirect()->route('dashboard')->with('success', 'Attendance marked successfully!');

        }else{
        return redirect()->route('dashboard')->with('danger', 'get in the office first!');    
        }

    }

    // Method to view attendance history
    public function viewHistory()
    {
        $user = auth()->user(); // Get the currently logged-in user
        // $method = request()->ip();
        // dd($method);
        // Fetch attendance records for the logged-in user
        $attendanceHistory = Attendance::where('user_id', $user->id)->orderBy('id', 'asc')->get();

        return view('attendance.history', ['attendanceHistory' => $attendanceHistory]);
    }

}
