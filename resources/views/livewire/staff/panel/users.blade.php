<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <!-- Заголовок и поиск -->
    <div class="mb-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white bg-clip-text bg-gradient-to-r from-purple-400 to-pink-600">
            Управление пользователями
        </h1>
        <input wire:model.live="search" type="text" 
            class="bg-gray-900 text-gray-300 rounded-lg border border-gray-800 px-4 py-2 focus:border-purple-500 focus:ring-purple-500"
            placeholder="Поиск пользователей...">
    </div>

    <!-- Таблица пользователей -->
    <div class="overflow-x-auto rounded-lg border border-gray-800 shadow-xl">
        <table class="min-w-full divide-y divide-gray-800">
            <thead class="bg-gray-900">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Репутация</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Последний вход</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Дата регистрации</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase">Действия</th>
                </tr>
            </thead>
            <tbody class="bg-gray-900 divide-y divide-gray-800">
                @foreach($users as $user)
                <tr class="hover:bg-gray-800 transition-colors">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->username }} 
                        @if($user->isBanned())
                        <span class="ml-1 px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-900 text-red-200">
                            banned
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($user->role === 'admin') bg-red-900 text-red-200
                            @elseif($user->role === 'moderator') bg-yellow-900 text-yellow-200
                            @else bg-green-900 text-green-200 @endif">
                            {{ $user->role }}
                        </span> 
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->reputation }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->last_seen }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $user->created_at }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <button wire:click="openModal({{ $user->id }})" 
                            class="text-purple-400 hover:text-purple-300 transition-colors hover:glow">
                            Действия
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Пагинация -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>

    <!-- Модальное окно -->
    @if($isModalOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-gray-900 rounded-lg p-6 max-w-md w-full mx-4 border border-purple-500 shadow-xl">
            <!-- Заголовок модального окна -->
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-purple-400">
                    Управление пользователем {{ $selectedUser->username }}
                </h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-200">
                    ✕
                </button>
            </div>

            <div class="space-y-6">
                <!-- Созданные материалы -->
                <div>
                    <h4 class="text-purple-400 mb-2">Созданные материалы:</h4>
                    <a href="#" 
                        class="text-gray-300 hover:text-purple-400 transition-colors">
                        Просмотреть →
                    </a>
                </div>

                <!-- Смена роли -->
                <div>
                    <label class="block text-gray-300 mb-2">Роль пользователя:</label>
                    <select wire:model="role" wire:change="updateRole"
                        class="w-full bg-gray-800 text-gray-300 rounded px-3 py-2 border border-gray-600 focus:border-purple-500 focus:ring-purple-500">
                        <option value="user">User</option>
                        <option value="moderator">Moderator</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- Изменение репутации -->
                <div>
                    <label class="block text-gray-300 mb-2">Репутация:</label>
                    <div class="flex space-x-2">
                        <input wire:model="reputation" type="number"
                            class="flex-1 bg-gray-800 text-gray-300 rounded px-3 py-2 border border-gray-600 focus:border-purple-500 focus:ring-purple-500">
                        <button wire:click="updateReputation"
                            class="bg-purple-600 hover:bg-purple-700 text-white rounded px-4 py-2 transition-colors">
                            Обновить
                        </button>
                    </div>
                </div>

                @if($selectedUser->isBanned())
                    <div>
                        <div class="text-red-500 mb-4">
                            <label class="block mb-2">Информация о блокировке:</label>
                            <div>Причина: {{ $selectedUser->isBanned()->reason }}</div>
                            <div>Тип: {{ $selectedUser->isBanned()->type }}</div>
                            <div>Дата выдачи бана: {{ $selectedUser->isBanned()->created_at }}</div>
                            <div>Дата окончания бана: {{ $selectedUser->isBanned()->expires_at }}</div>
                        </div>
                        <button wire:click="banUser"
                            class="w-full bg-green-600 hover:bg-green-700 text-white rounded px-4 py-2 transition-colors">
                            Разбанить
                        </button>
                    </div>
                @else
                    <div>
                        <label class="block text-gray-300 mb-2">Параметры бана:</label>
                        <input wire:model="banDays" type="number" placeholder="Срок бана (дни)" value="1"
                            class="w-full bg-gray-800 text-gray-300 rounded px-3 py-2 border border-gray-600 focus:border-purple-500 focus:ring-purple-500 mb-2">
                        <div class="flex items-center space-x-2 mb-2">
                            <input wire:model="banIp" type="checkbox" id="banIp"
                                class="rounded border-gray-600 text-purple-500 focus:ring-purple-500">
                            <label for="banIp" class="text-gray-300">Бан по IP</label>
                        </div>
                        <button wire:click="banUser"
                            class="w-full bg-red-600 hover:bg-red-700 text-white rounded px-4 py-2 transition-colors">
                            Забанить
                        </button>
                    </div>
                @endif
                

                <!-- Удаление -->
                <button wire:click="deleteUser" 
                    onclick="confirm('Вы уверены, что хотите удалить этого пользователя?') || event.stopImmediatePropagation()"
                    class="w-full bg-red-900 hover:bg-red-800 text-white rounded px-4 py-2 transition-colors">
                    Удалить аккаунт
                </button>
            </div>
        </div>
    </div>
    @endif
</div>