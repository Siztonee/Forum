<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;

class OnlineUsers extends Component
{
    public function render()
    {
        $onlineUsers = User::where('last_seen', '>', Carbon::now()->subMinutes(5))->get();

        return view('livewire.online-users', compact('onlineUsers'));
    }
}
