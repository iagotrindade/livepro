<div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between mb-3">
        <div class="flex justify-center items-center">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Tráfego do
                Website</h5>
            <svg data-popover-target="visitors-chart-info" data-popover-placement="bottom"
                class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
            </svg>
            <div data-popover id="visitors-chart-info" role="tooltip"
                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                <div class="p-3 space-y-2">
                    <h3 class="font-semibold text-gray-900 dark:text-white">Crescimento de Atividade -
                        Incremental</h3>
                    <p>O relatório ajuda a navegar pelo crescimento cumulativo das atividades da comunidade. Idealmente,
                        o gráfico deve ter uma tendência crescente, como gráfico estagnado significa um diminuição
                        significativa da atividade comunitária.</p>
                </div>
                <div data-popper-arrow></div>
            </div>
        </div>
        
    </div>

    <div>
        <div class="flex" id="devices">
            <div class="flex items-center me-4">
                <input id="desktop" type="checkbox" value="desktop"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="desktop" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Desktop</label>
            </div>
            <div class="flex items-center me-4">
                <input id="tablet" type="checkbox" value="tablet"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="tablet" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Tablet</label>
            </div>
            <div class="flex items-center me-4">
                <input id="mobile" type="checkbox" value="mobile"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label for="mobile" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Mobile</label>
            </div>
        </div>
    </div>

    <!-- Donut Chart -->
    <div class="py-2" id="visitors-chart" data-info='@json($data)' data-devices='@json($devices)' data-total='@json($total)'></div>

    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
        <div class="flex justify-between items-center pt-5">
            <!-- Button -->
            <button id="dropdownDefaultButton" data-dropdown-toggle="visitorsLastDaysdropdown"
                data-dropdown-placement="bottom"
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
            <div id="visitorsLastDaysdropdown"
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
            @can('downloadMarketing')
                <a href="https://marketingplatform.google.com/about/analytics/" target="_blank"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Análise de Tráfego
                    <svg class="w-2.5 h-2.5 ms-1.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                </a>
            @endcan
        </div>
    </div>
</div>


