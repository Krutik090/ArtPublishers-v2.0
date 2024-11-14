<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ReviewDataTable;
use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function index(ReviewDataTable $dataTable){
        return $dataTable->render('admin.Arts.art-review.index');
    }
    function updatestatus(string $id){

        $review = Review::findOrFail($id);
        $review->is_approved = !$review->is_approved;
        $review->save();
        return response(['status' => 'success','message'=>'updated successfully']);
    }

    function destroy(string $id){
        try{
            
            Review::findOrFail($id)->delete();
            return response(['status' => 'success','message' => 'Deleted Successfully']);

        }
        catch(\Exception $e){

            logger($e);
            return response(['status' => 'error','message' => $e->getMessage()]);

        }
    }
}
