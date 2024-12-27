<?php

namespace App\Services;

use App\Models\User;

class HandleMentionsService
{
    public function handle(string $content): array
    {
        $mentionedUsers = [];

        $content = preg_replace_callback('/@(\w+)/', function ($matches) use (&$mentionedUsers) {
            $username = $matches[1];
            $user = User::where('username', $username)->first();

            if ($user) {
                $mentionedUsers[] = $user->id;
                return view('components.username', ['user' => $user])->render();
            }

            return '@' . $username;
        }, $content);

        return [$content, $mentionedUsers];
    }
}