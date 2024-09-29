<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;

class VideoGalleryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $videos = VideoGallery::where('art_id',$request->id)->get();
        return view('admin.video-gallery.index',compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'video_url' => ['required','url'],
            'art_id' => ['required'],
        ]);

        $video = new VideoGallery();
        $video->art_id = $request->art_id;
        $video->video_url = $request->video_url;
        $video->save();

        toastr()->success("Uploaded Successfully");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{

            $video = VideoGallery::findOrFail($id);
            $video->delete();

            return response(['status' => 'success','message' => 'Deleted Successfully']);

        }
        catch(\Exception $e){

            logger($e);
            return response(['status' => 'error','message' => $e->getMessage()]);

        }
    }
}
