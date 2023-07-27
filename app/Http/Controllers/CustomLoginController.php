<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if(Auth::check()){
			return redirect()->route('admin.dashboard');
		}
        $viewData = array(
            'pageName' => 'Login'
        );
        return view('admin.auth.login')->with($viewData);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user) 
        {
            if ($user->status === 'inactive') 
            {
                $pageName = 'Login';
                // $viewData = array(
                //     'pageName' => 'Login'
                // );
                // echo "if";
                // print_r ($viewData);
                // die;
                return view('admin.auth.login',compact('pageName'))->with('user', $user);
            } 
            else 
            {
                $pageName = 'Login';
                // echo "else";

                // print_r( $viewData);
                // die;
                return view('admin.auth.login',compact('pageName'))->with('user',$user);
            }
        } 
        else
        {
            return redirect()->back()->with('error', 'No user with the provided email found.');
        }
    }

    public function setPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
        $user->password = bcrypt($request->input('password'));
        $user->status = 'active';
        $user->save();
        
        Auth::login($user);
        return redirect('/redirect')->with('success', 'Account activated. You are now logged in.');
    }
}