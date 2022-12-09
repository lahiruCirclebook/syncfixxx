<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AddEmployee;
use App\Models\Outsource;
use App\Models\UserPrivilege;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{
    //user dashboard
    public function userDashboard()
    {
        $activeUsers = User::where('isActive', 1)
            ->count('userId');

        $inactiveUsers = User::where('isActive', 0)
            ->count('userId');

        $activeEmployees = AddEmployee::where('isActive', 1)
            ->count('randomEmpId');

        $outLabours = Outsource::where('isActive', 1)
            ->distinct()
            ->count('id');


        return view('user.userDashboard', compact(['activeUsers', 'inactiveUsers', 'activeEmployees', 'outLabours']));
    }
    //login
    public function Login(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'isActive' => 1])) {
            $id = Auth::user()->id;
            $role = Auth::user()->role;


            session()->put('id', $id);
            session()->put('role', $role);

            return redirect('/home');
        } else {

            return view('home.login')->withErrors(['Incorrect Login Details', 'The Message']);
        }
    }

    //logout
    public function Logout()
    {

        session()->forget('role');
        session()->forget('id');
        session()->flush();

        return redirect('/');
    }

    //user management
    public function UserManagement()
    {

        $data = User::all();

        return view('user.userManagement')->with('data', $data);
    }


    //add users
    public function AddUser(Request $request)
    {

        $this->validate($request, [
            'email' => 'unique:users'
        ]);


        $userId = Str::random(7);

        $user = new User;

        $user->userId = $userId;
        $user->empId = $request->empId;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->password = Hash::make($request->password);
        $user->isActive = 1;


        $user->save();

        $privilegesId = Str::random(7);

        $userPrivilege = new UserPrivilege();

        $userPrivilege->privilegesId = $privilegesId;
        $userPrivilege->userId = $userId;
        $userPrivilege->hr = $request->get('hr');
        $userPrivilege->supervisor = $request->get('supervisor');
        $userPrivilege->pm = $request->get('pm');

        $userPrivilege->save();

        return redirect()->back()->with('message', 'New User Added !');
    }


    //change password view
    public function ChangePasswordView($id)
    {

        return view('user.changePassword')->with('id', $id);
    }

    //change password
    public function ChangePassword(Request $request)
    {

        $id = $request->id;
        $cPwd = $request->cPwd;
        $newPwd = $request->newPwd;

        $data = User::find($id);

        $oldPwd = $data->password;


        if (Hash::check($cPwd, $oldPwd)) {
            $user = User::find($id);
            $user->password = Hash::make($newPwd);
            $user->save();

            return redirect()->back()->with('message', 'Password Changed Successfully !');
        } else {
            return redirect()->back()->with('error', 'Your Current password does not matches with the password you provided. Please try again.');
        }
    }

    //edit profile view
    public function EditProfileView($id)
    {

        $data = User::find($id);

        return view('user.editProfile')->with('data', $data);
    }

    //edit profile
    public function EditProfile(Request $request)
    {


        $id = $request->id;

        User::where(['id' => $id])->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);
        return redirect()->back()->with('message', 'User Details Edited');
    }

    //reset password
    public function ResetPassword(Request $request)
    {

        $userId = $request->userId;

        User::where(['userId' => $userId])->update([
            'password' => Hash::make($request->pwd)
        ]);
        return redirect()->back()->with('message', 'Password Reset Successfully');
    }

    //disable user
    public function DisableUser($userId)
    {

        User::where(['userId' => $userId])->update([
            'isActive' => 0
        ]);
        return redirect()->back()->with('message', 'User Disable Successfully');
    }

    //view disable users
    public function disabledUsers()
    {

        $data = User::where('isActive', 0)->get();

        return view('user.disabledUsers')->with('data', $data);
    }
}
