<?php

namespace App\Http\Controllers\admin;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //admin profile
    public function profile(){
        $userData = User::where('id',Auth::user()->id)->first();
        return view('admin.account.profile', compact('userData'));
    }

    //navigate to Change Password
    public function navigateChangePassword(){
        $userData = User::where('id', Auth::user()->id)->first();
        return view('admin.account.changePassword', compact('userData'));
    }

    //change password
    public function changePassword(Request $request){
        $this->validation($request);
        $registeredUserPassword = Auth::user()->password;

        if(Hash::check($request->oldPassword, $registeredUserPassword)){
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
            logger(Hash::make($request->newPassword));

        }

        alert()->success('Success Change Password');
        return to_route('account#profile');
    }

    //navigate edit page
    public function edit(){
        $userData = User::where('id', Auth::user()->id)->first();
        return view('admin.account.edit', compact('userData'));
    }

    //edit user data
    public function editProfile(Request $request){
        $userData = $this->getUserData($request);

        if($request->hasfile('image')){
            if(file_exists(public_path('profilePhoto/'.$request->image))){
                unlink(public_path('profilePhoto/'.$request->image));
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profilePhoto/', $fileName);
            $userData['profile'] = $fileName;
        }
        User::where('id', Auth::user()->id)->update($userData);
        alert()->success('Profile Update Success', 'Profile Updated Successfully');
        return to_route('account#profile');
    }

    //get user data
    private function getUserData(Request $request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }


    //validate password data
    private function validation(Request $request){
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|max:25',
            'confirmPassword' => 'required|min:8|max:25|same:newPassword'
        ]);
    }

    //navigate to new admin addition page
    public function newAdmin(){
        return view('admin.account.newAdmin');
    }

    //add new admin
    public function addNewAdmin(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:8', 'max:25'],
            'confirmPassword' => ['required','same:password','min:8', 'max:25']
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ];

        User::create($userData);

        alert()->success('New Admin Account Added Successfully');
        return to_route('admin#dashboard');
    }

    //add new instructor
    public function addNewInstructor(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'min:8', 'max:25'],
            'confirmPassword' => ['required','same:password','min:8', 'max:25']
        ]);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'instructor'
        ];

        User::create($userData);

        alert()->success('New Instructor Account Added Successfully');
        return to_route('admin#dashboard');
    }

    //add new instructor navigation
    public function instructorAdd(){
        return view('admin.instructor.create');
    }

    //delete account
    public function delete($id){
        User::where('id',$id)->delete();
        alert()->success('Account Deleted Successfully');

        return back();
    }
}
