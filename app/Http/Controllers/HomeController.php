<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;

class HomeController extends Controller
{
    public function redirect(Request $request) 
    {
        $usertype = Auth::user()->usertype;
        if($usertype == '1')
        {
            $user = $request->user();
            $viewData = array(
                'pageName' => 'adminDashboard',
                'breadCrumbs' => array(
                    (object)array(
                        'name' => 'adminDashboard',
                        'class' => '',
                        'url' => 'javascript:;'
                    )
                ),
                'userData' => $user
            );
            return view('admin.dashboard')->with($viewData);
        }
        else
            {
                $user = $request->user();
            $viewData = array(
                'pageName' => 'userDashboard',
                'breadCrumbs' => array(
                    (object)array(
                        'name' => 'userDashboard',
                        'class' => '',
                        'url' => 'javascript:;'
                    )
                ),
                'userData' => $user
            );
            return view('user.dashboard')->with($viewData);
            }
    }
    public function showRegistrationForm(Request $request)
    {
        $user = $request->user();
            $viewData = array(
                'pageName' => 'Register',
                'breadCrumbs' => array(
                    (object)array(
                        'name' => 'Register New User',
                        'class' => '',
                        'url' => 'javascript:;'
                    )
                ),
                'userData' => $user
            );
        return view('admin.register')->with($viewData);
    }
    public function register(Request $request)
    {
        // Check if the user is an admin
        if (auth()->check() && auth()->user()->usertype == 1) {
            // Validation for admin user registration
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
            ]);

            // Create the new user with inactive status
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'status' => 'inactive', // Set the status to "inactive"
            ]);

            return redirect()->back()->with('success', 'User registered successfully!');
        } else {
            return redirect('/home')->with('error', 'You do not have permission to access this page.');
        }
    }
    public function dashboard(Request $request){
		$user = $request->user();
		// print_r($user);exit;
        $viewData = array(
            'pageName' => 'Dashboard',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'Dashboard',
                    'class' => '',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
            // $pageName = 'Dashboard';
            // $breadCrumbs = array(
            //             (object)array(
            //                 'name' => 'Dashboard',
            //                 'class' => '',
            //                 'url' => 'javascript:;'
            //             )
            //             );
        return view('admin.dashboard')->with($viewData);
    }
    public function showusersattendance(Request $request){
        $attendanceHistory = Attendance::all();
        $user = $request->user();
		// print_r($user);exit;
        $viewData = array(
            'pageName' => 'Users Attendance',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'User Attendence',
                    'class' => '',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
        return view('admin.attendence',compact('attendanceHistory'))->with($viewData);
    }
    public function showeditform(Request $request){
        $user = $request->user();
        $viewData = array(
            'pageName' => 'Users Attendance Edit',
            'breadCrumbs' => array(
                (object)array(
                    'name' => 'User Attendence Edit',
                    'class' => '',
                    'url' => 'javascript:;'
                )
            ),
			'userData' => $user
        );
        return view('admin.uaedit')->with($viewData);    
    }
    public function submitedit(Request $request)
    {
        // echo ($request->id);
        // echo ($request->status);
        // // echo ($request->new_status);
        // die;
        $id = $request->id;
        $status = $request->status;
    
        // Use the correct syntax to update the status in the database
        $is = Attendance::where('id', $id)->update(['status' => $status]);
        if($is){
            return response()->back()->with('success', 'Attendance updated successfully!');

        }else{
        return redirect()->back()->with('error', 'some error!');
        }
    
    }
}
