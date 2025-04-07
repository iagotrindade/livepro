<div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
    <div class="flex justify-between items-start w-full">
        <div class="flex-col items-center">
            <div class="flex items-center mb-1">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white me-1">Documentos dos
                    Profissionais</h5>
                <svg data-popover-target="chart-info" data-popover-placement="bottom"
                    class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                </svg>
                <div data-popover id="chart-info" role="tooltip"
                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                    <div class="p-3 space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Quantitativo de documentações</h3>
                        <p>O gráfico auxilia a visualizar o andamento das validações de documentação dos novos
                            profissionais.</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
        </div>
        <div class="flex justify-end items-center">
            <div id="widgetDropdown"
                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="widgetDropdownButton">
                    <li>
                        <a href="#"
                            class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                <path
                                    d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                            </svg>Download data
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m5.953 7.467 6.094-2.612m.096 8.114L5.857 9.676m.305-1.192a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0ZM17 3.84a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Zm0 10.322a2.581 2.581 0 1 1-5.162 0 2.581 2.581 0 0 1 5.162 0Z" />
                            </svg>Add to repository
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"><svg
                                class="w-3 h-3 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 18 20">
                                <path
                                    d="M17 4h-4V2a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v2H1a1 1 0 0 0 0 2h1v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V6h1a1 1 0 1 0 0-2ZM7 2h4v2H7V2Zm1 14a1 1 0 1 1-2 0V8a1 1 0 0 1 2 0v8Zm4 0a1 1 0 0 1-2 0V8a1 1 0 0 1 2 0v8Z" />
                            </svg>Delete widget
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Line Chart -->
    <div class="py-6" id="documents-chart" data-info='@json($chartData['values'])'></div>

    <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between">
        <div class="flex justify-between items-center pt-5">
            <!-- Button -->
            <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
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
            <div id="lastDaysdropdown"
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
            @can('downloadDocs')
                <a href="{{ route('dashboard.reports.documents') }}"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Relatório completo
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
