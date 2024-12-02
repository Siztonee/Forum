<?php

namespace App\Http\Controllers\Staff;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;

class CreateCategoryController extends Controller
{
    public function index()
    {
        return view('staff.create-category');
    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        $data['creator_id'] = auth()->id();
        $data['slug'] = Category::createUniqueSlug($data['name']);

        $category = Category::firstOrCreate($data);

        if ($category->wasRecentlyCreated) {
            return redirect()->route('categories')->with('info', 'Category created successfully!');
        }
            
        return back()->with('info', 'Category already exists.');
    }

}
