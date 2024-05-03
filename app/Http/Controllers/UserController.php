<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function userLogin(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                session(['user' => $user]); // Store user data in session
                return redirect('/viewTasksPage');
            }
            else {
                //Session::flash('error', 'LogIn Failed!! Wrong Email / Password!');
                //dd(session('error')); // Add this line to check if the error message is stored in the session
                $errorMessage = 'LogIn Failed!! Wrong Email / Password!';
                return view('userLoginPage')->with('errorMessage', $errorMessage);
            }

            throw ValidationException::withMessages(['email' => 'The provided credentials do not match our records.']);
        } catch (ValidationException $e) {
            return 'Exception';
        }
    }
    
    public function userRegister(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:255|confirmed',
            'select_role' => 'required'
        ]);
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('select_role'),
        ]);
        $user->save();

        if ($request->input('select_role') === 'admin') {
            // Mark the user as pending approval
            $user->update(['is_approved' => false]);
            $request->session()->put('registered_user', $user);
            // Redirect to a page indicating that the registration is successful
            return redirect('/registrationsuccessPage')->with('success', 'Registration successful. Your account is pending approval.');
        } else {
            return redirect('/userLoginPage')->with('success', 'User registered successfully!');
        }
    }

    public function adminApprovalPage() {
        $users = User::where('role', 'admin')->where('is_approved', false)->get();
        return view('adminApprovalPage', compact('users'));
    }

    public function myProfilePage() {
        $user = auth()->user();
    
        $tasksPickedUp = collect();
        $tasksCreated = collect();
    
        if ($user->role === 'user') {
            $tasksPickedUp = Task::where('picked_up_by', $user->id)->get();
        } elseif ($user->role === 'admin') {
            $tasksCreated = Task::where('posted_by', $user->id)->get();
        }
    
        return view('myProfilePage', compact('user', 'tasksPickedUp', 'tasksCreated'));
    }
    

}
