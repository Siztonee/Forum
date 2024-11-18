<?php

namespace App\Http\Controllers\Staff;

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
        dd($request);

        return 0;
    }
}
