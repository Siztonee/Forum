<?php

namespace App\Livewire\Staff\Panel;

use App\Models\Ban;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\NotificationService;

class Users extends Component
{
    use WithPagination;

    public $search, $selectedUser, $role, $message;
    public $reputation = 0, $banDays = 1, $banIp = false, $isModalOpen = false;


    public function mount()
    {
        $this->resetModal();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($userId)
    {
        $this->selectedUser = User::findOrFail($userId);
        $this->role = $this->selectedUser->role;
        $this->reputation = $this->selectedUser->reputation;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetModal();
    }

    public function resetModal()
    {
        $this->selectedUser = null;
        $this->role = '';
        $this->reputation = 0;
        $this->banDays = 1;
        $this->banIp = false;
        $this->resetValidation();
    }

    public function updateRole()
    {
        $this->selectedUser->update(['role' => $this->role]);
        $this->dispatch('success', ['message' => 'Роль успешно обновлена']);
    }

    public function updateReputation()
    {
        $this->selectedUser->update(['reputation' => $this->reputation]);
        $this->dispatch('success', ['message' => 'Репутация успешно обновлена']);
    }

    public function sendNotification(NotificationService $notificationService)
    {
        $notificationService->createNotification(
            sender_id: auth()->id(),
            receiver_id: $this->selectedUser->id,
            type: 'system',
            message: $this->message
        );

        $this->dispatch('success', ['message' => 'Уведомление успешно отправлено']);
        $this->closeModal();
    }

    public function banUser()
    {
        Ban::create([
            'user_id' => $this->selectedUser->id,
            'ip' => request()->ip(),
            'reason' => 'Panel',
            'type' => $this->banIp ? 'ip' : 'account',
            'expires_at' => now()->addDays((int)$this->banDays)
        ]);

        $this->dispatch('success', ['message' => 'Пользователь забанен']);
        $this->closeModal();
    }

    public function unbanUser()
    {
        $ban = Ban::where('user_id', $this->selectedUser->id)
           ->where('expires_at', '>', now())
           ->first();        

        if ($ban) {
            $ban->update(['expires_at' => now()]);
            $this->dispatch('success', ['message' => 'Пользователь разбанен']);
            $this->closeModal();
        }
        
        $this->closeModal();
    }

    public function deleteUser()
    {
        $this->selectedUser->delete();
        $this->dispatch('success', ['message' => 'Пользователь удален']);
        $this->closeModal();
    }

    public function render()
    {
        $users = User::where('username', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.staff.panel.users', [
            'users' => $users
        ])->extends('layouts.app');
    }
}
