<?php

namespace App\Http\Controllers\admin;

use App\DataTables\LocationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LocationStoreRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
