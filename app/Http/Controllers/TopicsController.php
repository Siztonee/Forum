<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Category;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function index($slug)
{
    $category = Category::where('slug', $slug)->first();

    if ($category) {
        $topics = Topic::where('category_id', $category->id)
            ->withCount('messages')
            ->with(['lastMessage' => function($query) {
                $query->with('sender:id,username,profile_image');
            }])
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        return view('topics', compact('category', 'topics'));
    }

    return back()->with('error', 'Категория не найдена!');
}
}
