<?php

namespace App\Http\Controllers\frontend;

use App\DataTables\ArtsDataTable;
use App\DataTables\UserArtsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\UserArtStoreRequest;
use App\Http\Requests\frontend\UserArtUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use App\Models\Location;
use App\Models\Amenity;
use App\Models\ArtAmenities;
use App\Traits\FileUploadTrait;
use Str;
use App\Models\Arts;
use Illuminate\Support\Facades\Auth;



class UserArtController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(UserArtsDataTable $dataTable): View|JsonResponse
    {
        return $dataTable->render('frontend.dashboard.arts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $category = Category::all();
        $location = Location::all();
        $amenity = Amenity::all();
        return view('frontend.dashboard.arts.create',compact('category', 'location', 'amenity'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserArtStoreRequest $request)
    {

        $imagePath = $this->uploadImage($request, 'image');
        $thumbanilPath = $this->uploadImage($request, 'thb_image');
        $attachmentPath = $this->uploadImage($request, 'attachment');


        $art = new Arts();
        $art->image = $imagePath;
        $art->user_id = Auth::user()->id;
        $art->thumbnail = $thumbanilPath;
        $art->title = $request->title;
        $art->slug = Str::slug($request->title);
        $art->package_id = 0;
        $art->category_id = $request->category;
        $art->location_id = $request->location;
        $art->address = $request->address;
        $art->phone = $request->phone;
        $art->email = $request->email;
        $art->website = $request->website;
        $art->fb_link = $request->fb_link;
        $art->x_link = $request->x_link;
        $art->insta_link = $request->insta_link;
        $art->file = $attachmentPath;
        $art->description = $request->description;
        $art->google_map_link = $request->google_map;
        $art->seo_title = $request->seo_title;
        $art->seo_description = $request->seo_description;
        $art->status = $request->status;
        $art->is_featured = $request->is_featured;
        $art->is_verified = $request->is_verified;
        $art->expire_date = date('Y-m-d');

        $art->save();

        if(!empty($request->amenities)){
            foreach ($request->amenities as $amenityId) {
                $amenity = new ArtAmenities();
                $amenity->art_id = $art->id;
                $amenity->amenity_id = $amenityId;
                $amenity->save();
        }


        }

        toastr()->success("Created Successfully");

        return to_route('account.arts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $arts = Arts::findOrFail($id);
        if(Auth::user()->id != $arts->user_id)
        {
            return abort(403);
        }
        $category = Category::all();
        $location = Location::all();
        $amenity = Amenity::all();
        $artamenity = ArtAmenities::where('art_id', $arts->id)->pluck('amenity_id')->toArray();
        return view('frontend.dashboard.arts.edit', compact('arts', 'location', 'amenity', 'category', 'artamenity'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserArtUpdateRequest $request, string $id)
    {
        $art = Arts::findOrFail($id);

        $imagePath = $this->uploadImage($request, 'image', $request->old_image);
        $thumbanilPath = $this->uploadImage($request, 'thb_image', $request->old_thb_image);
        $attachmentPath = $this->uploadImage($request, 'attachment', $request->old_attachment);

        $art->user_id = Auth::user()->id;
        $art->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $art->thumbnail = !empty($thumbanilPath) ? $thumbanilPath : $request->old_thb_image;
        $art->title = $request->title;
        $art->slug = Str::slug($request->title);
        $art->package_id = 0;
        $art->category_id = $request->category;
        $art->location_id = $request->location;
        $art->address = $request->address;
        $art->phone = $request->phone;
        $art->email = $request->email;
        $art->website = $request->website;
        $art->fb_link = $request->fb_link;
        $art->x_link = $request->x_link;
        $art->insta_link = $request->insta_link;
        $art->file = !empty($attachmentPath) ? $attachmentPath : $request->old_attachment;
        $art->description = $request->description;
        $art->google_map_link = $request->google_map;
        $art->seo_title = $request->seo_title;
        $art->seo_description = $request->seo_description;
        $art->status = $request->status;
        $art->is_featured = $request->is_featured;
        $art->is_verified = $request->is_verified;
        $art->expire_date = date('Y-m-d');

        $art->save();

        ArtAmenities::where('art_id', $art->id)->delete();
        if (!empty($request->amenities)) {
            foreach ($request->amenities as $amenityId) {
                $amenity = new ArtAmenities();
                $amenity->art_id = $art->id;
                $amenity->amenity_id = $amenityId;
                $amenity->save();
            }


        }

        toastr()->success("Updated Successfully");

        return to_route('account.arts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Arts::findOrFail($id)->delete();

            return response(['status' => 'success', 'message' => 'Deleted Successfully']);

        } catch (Exception $e) {

            logger($e);
            return response(['status' => 'error', 'message' => $e->getMessage()]);

        }
    }
}
