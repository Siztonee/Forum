<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index()
    {
        $categoriesQuery = Category::withCount([
            'topics', 
            'topics as messages_count' => function ($query) { 
                $query->withCount('messages');
            }
        ])->orderBy('created_at', 'DESC');

        if (Auth::check()) {
            switch (auth()->user()->role) {
                case 'admin':
                    $categories = $categoriesQuery->get();
                    break;
                case 'moderator':
                    $categories = $categoriesQuery->where('access', '!=', 'admin')->get();
                    break;
                default:
                    $categories = $categoriesQuery->where('access', 'user')->get();
                    break;
            }
        } else {
            $categories = $categoriesQuery->where('access', 'user')->get();
        }

        return view('categories', compact('categories'));
    }

}
