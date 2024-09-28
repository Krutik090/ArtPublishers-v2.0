<?php

namespace App\Http\Controllers\admin;

use App\DataTables\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LocationStoreRequest;
use App\Http\Requests\Admin\LocationUpdateRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Location;
use Str;


class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LocationDataTable $dataTable):View | JsonResponse
    {
        return $dataTable->render('admin.location.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.location.create');    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationStoreRequest $request)
    {
        $location = new Location();

        $location->name = $request->name;
        $location->slug = Str::slug($request->name);
        $location->show_at_home = $request->show_at_home;
        $location->status = $request->status;

        $location->save();

        toastr()->success("Created Successfully");

        return to_route('location.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = Location::findOrFail($id);
        return view('admin.location.edit',compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationUpdateRequest $request, string $id)
    {
        $location = Location::findOrFail($id);

        $location->name = $request->name;
        $location->slug = Str::slug($request->name);
        $location->show_at_home = $request->show_at_home;
        $location->status = $request->status;

        $location->save();

        toastr()->success("Updated Successfully");

        return to_route('location.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Location::findOrFail($id)->delete();

        return response(['status' => 'success')

    }
}
