<?php

namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait
{
    function uploadImage(Request $request, string $inputName, ?string $oldpath = null, string $path = '/uploads') : ?string
    {
        if($request->hasFile($inputName)){
            $image = $request->{$inputName};
            $ext = $image->getClientOriginalExtension(); //png jpg
            $imageName = 'media_' . uniqid() . '.' . $ext;

            $image->move(public_path($path),$imageName);

            //Delete Old Image
            $excludedFolder = '/default';

            if($oldpath && File::exists(public_path($oldpath)) && strpos($oldpath,$excludedFolder) !== 0){
                File::delete(public_path($oldpath));
            }

            return $path . '/' . $imageName; //   /uploads/filename.png   //.jpg.jpeg etc.
        }

        return null;
    }

    function deleteFile($path): void{
        //Delete  Image
        $excludedFolder = '/default';

        if($oldpath && File::exists(public_path($oldpath)) && strpos($oldpath,$excludedFolder) !== 0){
            File::delete(public_path($oldpath));
        }
    }
}
