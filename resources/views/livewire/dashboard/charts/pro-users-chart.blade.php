<div class="w-full h-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between">
        <div>
            <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">{{ $chartData['totalUsers'] }}</h5>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">Usuários PRO</p>
        </div>
        <div
            class="flex items-center px-2.5 py-0.5 text-base font-semibold text-green-500 dark:text-green-500 text-center">
            23%
            <svg class="w-3 h-3 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 13V1m0 0L1 5m4-4 4 4" />
            </svg>
        </div>
    </div>
    <div id="pro-users-chart" data-series='@json($chartData['series'])' data-categories='@json($chartData['categories'])'></div>

    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-5">
        <div class="flex justify-between items-center pt-0">
            <!-- Button -->
            <button id="dropdownDefaultButton" data-dropdown-toggle="proUsersLastDaysdropdown" data-dropdown-placement="bottom"
                class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center dark:hover:text-white"
                type="button">
                @if ($dateRange === 0)
                    Hoje
                @elseif ($dateRange === 1)
                    Ontem
                @else
                    Últimos {{ $dateRange }} dias
                @endif
                <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="proUsersLastDaysdropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                        wire:click="updateDateRange(1)">
                        Ontem
                    </li>

                    <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                        wire:click="updateDateRange(0)">
                        Hoje
                    </li>

                    <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                        wire:click="updateDateRange(7)">
                        Últimos 7 dias
                    </li>

                    <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                        wire:click="updateDateRange(30)">
                        Últimos 30 dias
                    </li>

                    <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                        wire:click="updateDateRange(90)">
                        Últimos 90 dias
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
