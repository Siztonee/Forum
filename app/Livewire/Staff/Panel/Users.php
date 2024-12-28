<?php

namespace App\Livewire\Staff\Panel;

use App\Models\Ban;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{

    use WithPagination;

    public $search = '';
    public $selectedUser = null;
    public $isModalOpen = false;
    public $role = '';
    public $reputation = 0;
    public $banDays = 0;
    public $banIp = false;

    protected $rules = [
        'role' => 'required|in:user,moderator,admin',
        'reputation' => 'required|numeric',
        'banDays' => 'nullable|numeric|min:0',
    ];

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
        $this->banDays = 0;
        $this->banIp = false;
        $this->resetValidation();
    }

    public function updateRole()
    {
        $this->validate([
            'role' => 'required|in:user,moderator,admin'
        ]);

        $this->selectedUser->update(['role' => $this->role]);
        $this->dispatch('success', 'Роль успешно обновлена');
    }

    public function updateReputation()
    {
        $this->validate([
            'reputation' => 'required|numeric'
        ]);

        $this->selectedUser->update(['reputation' => $this->reputation]);
        $this->dispatch('success', 'Репутация успешно обновлена');
    }

    public function banUser()
    {
        $validatedData = $this->validate([
            'banDays' => 'required|min:1'
        ]);

        Ban::create([
            'user_id' => $this->selectedUser->id,
            'ip' => request()->ip(),
            'reason' => 'Panel',
            'type' => $this->banIp ? 'ip' : 'account',
            'expires_at' => now()->addDays((int)$validatedData['banDays'])
        ]);

        $this->dispatch('info', 'Пользователь забанен');
        $this->closeModal();
    }

    public function deleteUser()
    {
        // Здесь логика удаления пользователя
        $this->selectedUser->delete();
        $this->dispatch('success', 'Пользователь удален');
        $this->closeModal();
    }

    public function render()
    {
        $users = User::where('username', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.staff.panel.users', [
            'users' => $users
        ])->extends('layouts.app');
    }
}
