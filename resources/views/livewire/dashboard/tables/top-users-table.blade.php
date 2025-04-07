<div class="p-4 w-full bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6 h-full">
    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">Top usuários deste mês
        <button data-popover-target="popover-description" data-popover-placement="bottom-end" type="button"><svg
                class="w-4 h-4 ml-2 text-gray-400 hover:text-gray-500" aria-hidden="true" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                    clip-rule="evenodd"></path>
            </svg><span class="sr-only">Mostrar informações</span></button>
    </h3>
    <div data-popover="" id="popover-description" role="tooltip"
        class="absolute z-10 inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 opacity-0 invisible"
        style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-303px, 81px);"
        data-popper-placement="bottom-end">
        <div class="p-3 space-y-2">
            <h3 class="font-semibold text-gray-900 dark:text-white">Estatísticas</h3>
            <p>Os usuários abaixo alcançaram destaque neste mês pela quantidade de serviços prestados ou quantidade de
                compras.</p>
        </div>
        <div data-popper-arrow="" style="position: absolute; left: 0px; transform: translate(271px, 0px);"></div>
    </div>
    <div class="sm:hidden">
        <label for="tabs" class="sr-only">Selecionar aba</label>
        <select id="tabs"
            class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
            <option>Estatísticas</option>
            <option>Serviços</option>
            <option>Avaliações</option>
        </select>
    </div>
    <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400"
        id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
        <li class="w-full">
            <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq"
                aria-selected="true"
                class="inline-block w-full p-4 rounded-tl-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300">Top
                Profissionais</button>
        </li>
        <li class="w-full">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about"
                aria-selected="false"
                class="inline-block w-full p-4 rounded-tr-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600 text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500">Top
                Clientes</button>
        </li>
    </ul>
    <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
        <div class="pt-4 hidden" id="faq" role="tabpanel" aria-labelledby="faq-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($topClients as $client)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <a href="{{ route('user', ['id' => $client->id]) }}">
                                    @if ($client->avatar)
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ url('storage/' . $client->avatar->file . '') }}"
                                            alt="Avatar" />
                                    @else
                                        <svg class="bg-white text-gray-500 w-7 h-7 dark:bg-gray-300 rounded-full"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </a>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                    {{ $client->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $client->email }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                R$ {{ $client->total_monthly_amount }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="pt-4" id="about" role="tabpanel" aria-labelledby="about-tab">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($topProfessionals as $professional)
                    <li class="py-3 sm:py-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                <a href="{{ route('user', ['id' => $professional->id]) }}">
                                    @if ($professional->avatar)
                                        <img class="w-8 h-8 rounded-full"
                                            src="{{ url('storage/assets/images/avatars/' . $professional->avatar->file . '') }}"
                                            alt="Avatar" />
                                    @else
                                        <svg class="bg-white text-gray-500 w-7 h-7 dark:bg-gray-300 rounded-full"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path fill-rule="evenodd"
                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    @endif
                                </a>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-gray-900 truncate dark:text-white">
                                    {{ $professional->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $professional->email }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                R$ {{ $professional->total_monthly_amount }}
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!-- Card Footer -->
    <div class="flex items-center justify-between pt-3 mt-5 border-t border-gray-200 sm:pt-6 dark:border-gray-700">
        <div>
            <button
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"
                type="button" data-dropdown-toggle="stats-dropdown">
                @if ($referenceDate->isToday())
                    Hoje
                @elseif ($referenceDate->isYesterday())
                    Ontem
                @else
                    {{ $referenceDate->diffForHumans() }}
                @endif
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                id="stats-dropdown" data-popper-placement="bottom"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(908.5px, 701px, 0px);">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            wire:click=changeReferenceDate('yesterday')>Ontem</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            wire:click=changeReferenceDate('today')>Hoje</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            wire:click=changeReferenceDate('lastSeven')>Últimos 7 dias</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            wire:click=changeReferenceDate('lastThirty')>Últimos
                            30 dias</a>
                    </li>
                    <li>
                        <a href="#"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            wire:click=changeReferenceDate('lastNinety')>Últimos
                            90 dias</a>
                    </li>
                </ul>
            </div>
        </div>
        @can('downloadMarketing')
            <div class="flex-shrink-0">
                <a href="{{ route('dashboard.top.users') }}"
                    class="uppercase text-sm font-semibold inline-flex items-center rounded-lg text-blue-600 hover:text-blue-700 dark:hover:text-blue-500  hover:bg-gray-100 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 px-3 py-2">
                    Relatório completo
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        @endcan
    </div>
</div>
