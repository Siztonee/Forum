<?php

namespace App\Http\Controllers\Staff;

use App\Models\Topic;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategorySettingsRequest;

class CategorySettingsController extends Controller
{
    protected function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function index($slug)
    {
        $category = $this->getCategoryBySlug($slug);

        return view('staff.category-settings', [
            'category' => $category,
        ]);
    }

    public function store($slug, CategorySettingsRequest $request)
    {
        $category = $this->getCategoryBySlug($slug);

        $category->update($request->validated());

        return redirect()->route('categories')->with('info', 'Категория успешно изменена!');
    }

    public function clear($slug)
    {   
        $category = $this->getCategoryBySlug($slug);

        Topic::where('category_id', $category->id)->delete();

        return redirect()->route('categories')->with('info', 'Категория успешно очищена!');
    }

    public function delete($slug)
    {
        $category = $this->getCategoryBySlug($slug);
        $category->delete();

        return redirect()->route('categories')->with('info', 'Категория успешно удалена!');
    }
}