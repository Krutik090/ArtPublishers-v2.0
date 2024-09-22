<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploadTrait;
    public function index(){

        $user = Auth::user();
        return view('frontend.dashboard.profile.index',compact('user'));

    }

    public function update(ProfileUpdateRequest $request): RedirectResponse{

        $user = Auth::user();

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
            'current_password' => ['required','current_password'],
            'password' => ['required','min:8','confirmed']
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();
        toastr()->success("Password Updated Successfully");
        return redirect()->back();
    }
}
