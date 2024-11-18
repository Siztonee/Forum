<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $usersTotal = User::all()->count();

        return view('home', compact('usersTotal'));
    }
}
