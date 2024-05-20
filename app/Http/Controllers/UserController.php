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
                return redirect('/viewTasksPage');
            }
            else {
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
            $user->update(['is_approved' => false]);
            return redirect('/registrationsuccessPage')->with('success', 'Registration successful. Your account is pending approval.');
        } else {
            $user->update(['is_approved' => true]);
            return redirect('/userLoginPage')->with('success', 'User registered successfully!');
        }
    }

    public function adminApprovalPage() {
        $users = User::where('role', 'admin')->where('is_approved', false)->get();
        return view('adminApprovalPage', compact('users'));
    }

    public function adminApprovedConfirmationPage($id) {
        $user = User::findOrFail($id);
        return view('adminApprovedConfirmationPage',compact('user'));
    }

    public function adminRejectedConfirmationPage($id) {
        $user = User::findOrFail($id);
        return view('adminRejectedConfirmationPage',compact('user'));
    }

    public function adminApproved($id) {
        $user = User::findOrFail($id);
        $user->role = 'admin';
        $user->is_approved = true;
        $user->save();
        return redirect('/adminApprovalPage');
    }

    public function adminRejected($id) {
        $user = User::findOrFail($id);
        $user->role = 'user';
        $user->is_approved = false;
        $user->save();
        return redirect('/adminApprovalPage');
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
