<?php

namespace App\Http\Controllers\admin;

use App\DataTables\PendingArtsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Arts;
use Illuminate\Http\Request;

class PendingArtController extends Controller
{
    function index(PendingArtsDataTable $dataTable){

        return $dataTable->render('admin.pending-arts.index');

    }

    function update(Request $request){
        $request->validate([
            'value' => ['boolean']
        ]);
        try{

            $arts = Arts::findOrFail($request->id);
            $arts->is_approved = $request->value;
            $arts->save();

            return response(['status' => 'success','message'=>'status updated successfully']);
        }catch(\Exception $e){
            return response(['status' => 'error','message'=>$e->getMessage()]);

        }
    }
}
