<div class="w-full rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="mx-auto">
        <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
            <div
                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                    <h5>
                        <span class="text-gray-500">Todos os serviços:</span>
                        <span class="dark:text-white">{{ App\Models\Schedule::count() }}</span>
                    </h5>
                    <h5>
                        <span class="text-gray-500">Total de vendas:</span>
                        <span class="dark:text-white">R$ {{ number_format($currentPageTotal, 2, ',', '.') }}</span>
                    </h5>
                </div>
                <div class="bg-yellow-400 bg-green-400 bg-orange-400 bg-red-400"></div>
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <div class="items-center sm:flex">
                        <div class="flex items-center">
                            <div class="">
                                <label for="table-search" class="sr-only">Search</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input type="text" id="table-search"
                                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10 mr-4"
                                        placeholder="Pesquisar..." wire:keyup="search($event.target.value)">
                                </div>
                            </div>
                            <button id="servicesTableDropdownDefault" data-dropdown-toggle="servicesTableDropdown"
                                class="mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    class="w-4 h-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Filtrar
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="servicesTableDropdown"
                                class="z-10 w-56 p-3 bg-white rounded-lg shadow dark:bg-gray-700 hidden"
                                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(1225px, 3026px);"
                                data-popper-placement="bottom">
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                    Status
                                </h6>
                                <ul class="space-y-2 text-sm" aria-labelledby="servicesTableDropdownDefault">
                                    <li class="flex items-center">
                                        <input id="apple" type="checkbox" value="finished"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            wire:change="filter($event.target.value)">

                                        <label for="apple"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Finalizado
                                        </label>
                                    </li>

                                    <li class="flex items-center">
                                        <input id="fitbit" type="checkbox" value="in_progress"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            wire:change="filter($event.target.value)">

                                        <label for="fitbit"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Em andamento
                                        </label>
                                    </li>

                                    <li class="flex items-center">
                                        <input id="dell" type="checkbox" value="scheduled"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            wire:change="filter($event.target.value)">

                                        <label for="dell"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Agendado
                                        </label>
                                    </li>

                                    <li class="flex items-center">
                                        <input id="asus" type="checkbox" value="canceled"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            wire:change="filter($event.target.value)">

                                        <label for="asus"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Cancelado
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path
                                            d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z">
                                        </path>
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" wire:model.lazy="startDate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 datepicker-input"
                                    placeholder="De" mask="**/**/****">

                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path
                                            d="M5.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H6a.75.75 0 01-.75-.75V12zM6 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H6zM7.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H8a.75.75 0 01-.75-.75V12zM8 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H8zM9.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V10zM10 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H10zM9.25 14a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H10a.75.75 0 01-.75-.75V14zM12 9.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V10a.75.75 0 00-.75-.75H12zM11.25 12a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H12a.75.75 0 01-.75-.75V12zM12 13.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V14a.75.75 0 00-.75-.75H12zM13.25 10a.75.75 0 01.75-.75h.01a.75.75 0 01.75.75v.01a.75.75 0 01-.75.75H14a.75.75 0 01-.75-.75V10zM14 11.25a.75.75 0 00-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 00.75-.75V12a.75.75 0 00-.75-.75H14z">
                                        </path>
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z">
                                        </path>
                                    </svg>
                                </div>
                                <input type="text" wire:model.lazy="endDate"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 datepicker-input"
                                    placeholder="Até">
                            </div>
                        </div>
                    </div>
                    @can('downloadServices')
                        <button wire:loading wire:target='exportServices' disabled type="button"
                            class="py-2.5 px-5 me-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">
                            <svg aria-hidden="true" role="status"
                                class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="#1C64F2" />
                            </svg>
                            Carregando...
                        </button>
                        <button type="button" wire:click="exportServices" wire:loading.remove
                            class="flex items-center justify-center flex-shrink-0 px-3 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Exportar
                        </button>
                    @endcan
                </div>
            </div>

            <p class="flex text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400">
                {{ $exportMessage }} </p>
            <div class="flex flex-col mt-6">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Profissioal</th>
                                        <th scope="col" class="px-4 py-3">Protocolo</th>
                                        <th scope="col" class="px-4 py-3">Status</th>
                                        <th scope="col" class="px-4 py-3">Data</th>
                                        <th scope="col" class="px-4 py-3">Pagamento</th>
                                        <th scope="col" class="px-4 py-3">Avaliação</th>
                                        <th scope="col" class="px-4 py-3">Gravação</th>
                                        <th scope="col" class="px-4 py-3">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($schedules as $service)
                                        <tr
                                            class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                            <!-- Avatar -->
                                            <th scope="row"
                                                class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                @if (optional($service->professional)->avatar)
                                                    <img class="w-8 h-8 rounded-full"
                                                        src="{{ url('storage/' . $service->professional->avatar->file) }}"
                                                        alt="{{ optional($service->professional)->name }}" />
                                                @else
                                                    <svg class="bg-white text-gray-500 w-7 h-7 dark:bg-gray-300 rounded-full"
                                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                        fill="currentColor" viewBox="0 0 24 24">
                                                        <path fill-rule="evenodd"
                                                            d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                @endif

                                                <p class="ml-5">{{ optional($service->professional)->name }}</p>
                                            </th>

                                            <!-- Protocol -->
                                            <td class="px-4 py-2">
                                                <span
                                                    class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300">
                                                    {{ $service->protocol ?? '-' }}
                                                </span>
                                            </td>

                                            <!-- Status -->
                                            <td
                                                class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <div class="flex items-center">
                                                    <div
                                                        class="inline-block w-4 h-4 mr-2 rounded-full {{ optional($service->status)->getStyles() ?? '' }}">
                                                    </div>
                                                    {{ optional($service->status)->getName() ?? 'Status desconhecido' }}
                                                </div>
                                            </td>

                                            <!-- Created At -->
                                            <td
                                                class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $service->created_at ? Str::upper($service->created_at->translatedFormat('d M y')) : '-' }}
                                            </td>

                                            <!-- Payment -->
                                            <td
                                                class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {!! optional($service->payment)->method->getIcon() ?? '<span>Icone indisponível</span>' !!}
                                            </td>

                                            <!-- Reviews -->
                                            <td
                                                class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                @php
                                                    $rating = $service->reviews->isEmpty()
                                                        ? 0
                                                        : $service->reviews->first()->rating;
                                                @endphp
                                                <div class="flex items-center">
                                                    @for ($i = 0; $i < 5; $i++)
                                                        <svg aria-hidden="true"
                                                            class="w-5 h-5 {{ $i < $rating ? 'text-yellow-400' : 'text-gray-400' }}"
                                                            fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                    <span class="ml-1 text-gray-500 dark:text-gray-400">
                                                        {{ number_format($rating, 1) }}
                                                    </span>
                                                </div>
                                            </td>

                                            <!-- Room Recording -->
                                            <td
                                                class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                @if (optional($service->room)->recording)
                                                    <a href="{{ $service->room->recording->url }}"
                                                        class="flex items-center" target="_blank">
                                                        <svg class="w-5 h-5 mr-2 text-gray-400" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M14 7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7Zm2 9.387 4.684 1.562A1 1 0 0 0 22 17V7a1 1 0 0 0-1.316-.949L16 7.613v8.774Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Download
                                                    </a>
                                                @else
                                                    <div class="flex items-center">
                                                        <svg class="w-5 h-5 mr-2 text-gray-400" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M14 7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7Zm2 9.387 4.684 1.562A1 1 0 0 0 22 17V7a1 1 0 0 0-1.316-.949L16 7.613v8.774Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        Indisponível
                                                    </div>
                                                @endif
                                            </td>

                                            <!-- Action -->
                                            <td
                                                class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{route('dashboard.service', $service->id)}}"
                                                    class="text-dark text-sm font-medium rounded-md  dark:text-white min-w-['84px'] hover:underline">
                                                    Visualizar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Mostrando
                    <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $schedules->firstItem() }}-{{ $schedules->lastItem() }}</span>
                    de
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $schedules->total() }}
                    </span>
                </span>
                {{ $schedules->links('vendor.pagination.custom') }}
            </nav>
        </div>
    </div>
</div>
