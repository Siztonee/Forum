<div class="mt-8 p-6 bg-gray-800 rounded-lg shadow-sm">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
      <h2 class="text-xl font-semibold">Регистрации пользователей</h2>
      <div class="grid grid-cols-3 sm:flex gap-2 w-full sm:w-auto">
        <button class="period-btn bg-gray-700 text-gray-100 px-4 py-2 rounded text-sm sm:text-base" data-period="day">День</button>
        <button class="period-btn bg-gray-700 text-gray-100 px-4 py-2 rounded text-sm sm:text-base" data-period="week">Неделя</button>
        <button class="period-btn bg-gray-700 text-gray-100 px-4 py-2 rounded text-sm sm:text-base" data-period="month">Месяц</button>
        <button class="period-btn bg-gray-700 text-gray-100 px-4 py-2 rounded text-sm sm:text-base" data-period="year">Год</button>
        <button class="period-btn bg-gray-700 text-gray-100 px-4 py-2 rounded text-sm sm:text-base" data-period="all">Все</button>
      </div>
    </div>
    <div class="h-[300px] sm:h-[400px] relative">
      <canvas id="registrationChart"></canvas>
    </div>
  </div>