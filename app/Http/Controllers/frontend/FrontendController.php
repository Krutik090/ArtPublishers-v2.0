<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Arts;
use App\Models\Review;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Hero;
use Illuminate\Validation\ValidationException;
class FrontendController extends Controller
{
    function index()
    {
        $hero = Hero::first();
        $categories = Category::where('status', 1)->get();
        return view('frontend.home.index', compact('hero', 'categories'));
    }

    function arts(Request $request)
    {
        $arts = Arts::with(['category', 'location'])->where(['status' => 1, 'is_approved' => 1]);

        $arts->when($request->has('category'), function ($query) use ($request) {
            $query->whereHas('category', function ($query) use ($request) {
                $query->where('slag', $request->category);
            });
        });
        $arts = $arts->paginate(12);
        return view('frontend.pages.arts', compact('arts'));
    }

    function artsmodel(string $id)
    {
        $arts = Arts::findOrFail($id);
        return view('frontend.layouts.arts-model', compact('arts'))->render();
    }

    function showArts(string $slug)
    {
        $arts = Arts::withAvg([
            'reviews' => function ($query) {
                $query->where('is_approved', 1);
            }
        ], 'rating')->where(['status' => 1, 'is_verified' => 1])->where('slug', $slug)->first();
        $similarArts = Arts::where('category_id', $arts->category_id)->where('id', '!=', $arts->id)->orderBy('id', 'DESC')->take(4)->get();

        $reviews = Review::with('user')->where(['art_id' => $arts->id, 'is_approved' => 1])->paginate(5);

        return view('frontend.pages.arts-view', compact('arts', 'similarArts', 'reviews'));
    }

    function submitReview(Request $request)
    {

        $request->validate([
            'rating' => ['required', 'in:1,2,3,4,5'],
            'review' => ['required', 'max:500'],
            'art_id' => ['required', 'integer']
        ]);

        $preReview = Review::where(['art_id' => $request->art_id, 'user_id' => auth()->user()->id])->exists();
        if ($preReview) {
            throw ValidationException::withMessages(['You already submit review for this art']);

        }

        $review = new Review();
        $review->art_id = $request->art_id;
        $review->user_id = auth()->user()->id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        toastr()->success('Review Added Successfully');
        return redirect()->back();

    }
}
