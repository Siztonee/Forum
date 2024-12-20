<?php

namespace App\Services;

use App\Models\User;

class HandleMentionsService
{
    public function handle(string $content): string
    {
        return preg_replace_callback('/@(\w+)/', function ($matches) {
            $username = $matches[1];
            $user = User::where('username', $username)->first();

            if ($user) {
                return '<a href="' . route('profile', $username) . '" class="mention-link">@' . $username . '</a>';
            }

            return '@' . $username;
        }, $content);
    }
}