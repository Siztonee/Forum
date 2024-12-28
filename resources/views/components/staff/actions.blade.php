<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mt-6">
    <a href="http://127.0.0.1:8080/phpmyadmin/index.php?route=/database/structure&db=forum" target="_blank" class="card"> 
      <div class="p-5 bg-gray-900 rounded-lg border border-gray-700 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff] transition-all duration-200">
        <div class="flex items-center">
          <div class="p-3 bg-yellow-500/10 rounded-lg flex items-center justify-center">
            <i class="fas fa-table fa-2x text-yellow-400"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium">Таблицы</h3>
            <p class="text-sm text-gray-400">Просмотр таблиц</p>
          </div>
        </div>
      </div>
    </a>
  
    <a href="{{ route('category.create') }}" class="card"> 
      <div class="p-5 bg-gray-900 rounded-lg border border-gray-700 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff] transition-all duration-200">
        <div class="flex items-center">
          <div class="p-3 bg-blue-500/10 rounded-lg flex items-center justify-center">
            <i class="fas fa-folder-plus fa-2x text-blue-400"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium">Создать категорию</h3>
            <p class="text-sm text-gray-400">Добавить новую категорию на форум</p>
          </div>
        </div>
      </div>
    </a>
  
    <a href="{{ route('panel.users') }}" class="card"> 
      <div class="p-5 bg-gray-900 rounded-lg border border-gray-700 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff] transition-all duration-200">
        <div class="flex items-center">
          <div class="p-3 bg-purple-500/10 rounded-lg flex items-center justify-center">
            <i class="fas fa-users fa-2x text-purple-400"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium">Пользователи</h3>
            <p class="text-sm text-gray-400">Управление пользователями</p>
          </div>
        </div>
      </div>
    </a>
  
    <a href="#" class="card"> 
      <div class="p-5 bg-gray-900 rounded-lg border border-gray-700 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff] transition-all duration-200">
        <div class="flex items-center">
          <div class="p-3 bg-green-500/10 rounded-lg flex items-center justify-center">
            <i class="fas fa-chart-line fa-2x text-green-400"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium">Статистика</h3>
            <p class="text-sm text-gray-400">Просмотр статистики форума</p>
          </div>
        </div>
      </div>
    </a>
  
    <a href="{{ route('categories') }}" class="card"> 
      <div class="p-5 bg-gray-900 rounded-lg border border-gray-700 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff] transition-all duration-200">
        <div class="flex items-center">
          <div class="p-3 bg-green-500/10 rounded-lg flex items-center justify-center">
            <i class="fas fa-sitemap fa-2x text-green-400"></i>
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium">Категории</h3>
            <p class="text-sm text-gray-400">Управление категориями форума</p>
          </div>
        </div>
      </div>
    </a>
  
    <a href="#" class="card"> 
      <div class="p-5 bg-gray-900 rounded-lg border border-gray-700 hover:shadow-[0_0_1px_#fff,0_0_2px_#0088ff] transition-all duration-200">
        <div class="flex items-center">
          <div class="p-3 bg-green-500/10 rounded-lg flex items-center justify-center">
            <i class="fas fa-hashtag fa-2x text-green-400"></i> 
          </div>
          <div class="ml-4">
            <h3 class="text-lg font-medium">Топики</h3>
            <p class="text-sm text-gray-400">Управление темами форума</p>
          </div>
        </div>
      </div>
    </a>
  </div>