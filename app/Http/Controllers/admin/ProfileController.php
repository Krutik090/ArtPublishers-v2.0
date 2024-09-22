<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\User;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;
    function index(){
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index', compact('user'));
    }

    function update(ProfileUpdateRequest $request) : RedirectResponse {

        $user = Auth::guard('admin')->user();

        $avatarpath = $this->uploadImage($request,'avatar', $user->avatar);
        $bannerpath = $this->uploadImage($request,'banner', $user->banner);

        $user->avatar = !empty($avatarpath) ? $avatarpath : $user->avatar;
        $user->banner = !empty($bannerpath) ? $bannerpath : $user->banner;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->about = $request->about;
        $user->website = $request->website;
        $user->fb_link = $request->fb_link;
        $user->x_link = $request->x_link;
        $user->in_link = $request->in_link;
        $user->wp_link = $request->wp_link;
        $user->insta_link = $request->insta_link;
        $user->save();

        //toastr()->success("Updated Successfully");

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    function passwordUpdate(Request $request){

        $request->validate([
            'password' => ['required','min:8','confirmed']
        ]);

        $user = Auth::guard('admin')->user();
        $user->password = bcrypt($request->password);
        $user->save();
        toastr()->success("Updated Successfully");
        return redirect()->back();
    }
}
