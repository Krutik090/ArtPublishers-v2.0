<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ImageGallery;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $images = ImageGallery::where('art_id', $request->id)->get();
        return view('admin.image-gallery.index',compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'images' => ['required'],
                'images.*' => ['image', 'max:7000'],
                'art_id' => ['required']
            ],[
                'images.*.image' => 'One or more selected files are not valid images',
                'images.*.max' => 'One or more selected files exceed the maximum file size(7MB)',
            ]
        );

        $imagepaths = $this->uploadMultipleImage($request,'images');

        foreach($imagepaths as $path){
            $image = new ImageGallery();
            $image->art_id = $request->art_id;
            $image->image = $path;
            $image->save();
        }

        toastr()->success("Uploaded Successfully");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $image = ImageGallery::findOrFail($id);
            $this->deleteFile($image->image);
            $image->delete();

            return response(['status' => 'success','message' => 'Deleted Successfully']);

        }
        catch(\Exception $e){

            logger($e);
            return response(['status' => 'error','message' => $e->getMessage()]);

        }
    }
}
