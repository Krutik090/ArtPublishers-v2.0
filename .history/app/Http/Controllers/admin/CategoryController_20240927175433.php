<?php

namespace App\Http\Controllers\admin;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CategoryStoreRequest;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Str;
use Illuminate\Http\RedirectResponse;


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
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $iconPath = $this->uploadImage($request, 'image_icon');
        $bgPath = $this->uploadImage($request, 'bg_image');

        $category = new Category();
        $category->image_icon = $iconPath;
        $category->bg_image = $bgPath;
        $category->name = $request->name;
        $category->slag = Str::slug($request->name);
        $category->show_at_home = $request->show_at_home;
        $category->status = $request->status;
        $category->save();

        toastr()->success("Created Successfully");

        return to_route('category.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $iconPath = $this->uploadImage($request, 'image_icon',$request->old_icon);
        $bgPath = $this->uploadImage($request, 'bg_image',$request->old_bg);

        $category = Category::findOrFail($id);
        $category->image_icon = !empty($iconPath) ? $iconPath : $request->old_icon;
        $category->bg_image = !empty($bgPath) ? $bgPath : $request->old_bg;
        $category->name = $request->name;
        $category->slag = Str::slug($request->name);
        $category->show_at_home = $request->show_at_home;
        $category->status = $request->status;
        $category->save();

        toastr()->success("Updated Successfully");

        return to_route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
