<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroUpdateRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use App\Models\Hero;


class HeroController extends Controller
{
    use FileUploadTrait;
    function index()
    {
        $hero = Hero::first();
        return view('admin.Hero.index',compact('hero'));
    }
    function update(HeroUpdateRequest $request)
    {
        $imagepath = $this->uploadImage($request, 'background',  $request->old_background );

        Hero::updateOrCreate(
            ['id' => 1],
            [
                'background' => !empty($imagepath) ? $imagepath : $request->old_background ,
                'title'=> $request->title,
                'subtitle'=> $request->subtitle
            ]
        );
        toastr()->success('Updated Successfully');

        return redirect()->back();
    }
}
