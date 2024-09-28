<?php

namespace App\Http\Controllers\admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryStoreRequest;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use I


class CategoryController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();

        $iconPath = $this->uploadImage($request, 'icon_image');
        $bgPath = $this->uploadImage($request, 'bg_image');

        $category->icon_image = $iconPath;
        $category->bg_image = $bgPath;
        $category->name = $request->name;
        $category->slag = Str::slag($request->name);
        $category->show_at_home = $request->show_at_home;
        $category->status = $request->status;
        $category->save();


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
