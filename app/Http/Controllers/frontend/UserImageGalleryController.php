<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Arts;
use App\Models\ImageGallery;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;

class UserImageGalleryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $images = ImageGallery::where('art_id', $request->id)->get();
        $arttitle = Arts::select('title')->where('id',$request->id)->first();
        return view('frontend.dashboard.arts.Image-Gallery.index',compact('images','arttitle'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
