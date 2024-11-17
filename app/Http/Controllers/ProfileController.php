<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index($username)
    {
        $user = User::where('username', $username)->first();

        if ($user) {
            return view('profile', compact('user'));
        }

        return redirect()->back()->with('error', 'Данный пользователь не найден!');
    }
}
