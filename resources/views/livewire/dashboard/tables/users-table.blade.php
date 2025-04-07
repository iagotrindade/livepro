<div>
    @can('viewUsers')
        <div class="flex justify-center mb-5">
            <div class="sm:hidden">
                <label for="tabs" class="sr-only">Filtrar por Cargo</label>
                <select wire:change="filterUsers($event.target.value)" id="tabs"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($roles as $role)
                        <option>{{ $role }}</option>
                    @endforeach
                </select>
            </div>
            <ul class="hidden text-sm font-medium text-center text-gray-500 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400"
                id="tabs">
                @foreach ($roles as $role)
                    <li class="w-full focus-within:z-10">
                        <a wire:click="filterUsers('{{ $role }}')"
                            class="@if ($loop->first) rounded-s-lg  @elseif($loop->last) rounded-e-lg @endif @if (in_array($role, $filter)) bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white @else bg-white dark:bg-gray-800 @endif cursor-pointer inline-block w-max p-4 hover:text-gray-700 hover:bg-gray-100 focus:outline-none dark:hover:text-white  dark:hover:bg-gray-700 ">{{ $role }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="w-full rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 ">
            <div
                class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                <div class="flex items-center flex-1 space-x-4">
                    <h5>
                        <span class="text-gray-500">Total de registros:</span>
                        <span class="dark:text-white">{{ App\Models\User::count() }}</span>
                    </h5>
                </div>
                <div
                    class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                    <div class="items-center sm:flex">
                        <div class="flex items-center">
                            <div class="">
                                <label for="table-search" class="sr-only">Pesquisar</label>
                                <div class="relative">
                                    <div
                                        class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                        </svg>
                                    </div>
                                    <input id="users-search" type="text" name="search" wire:model.live="search"
                                        autocomplete="off"
                                        class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white h-10 mr-4"
                                        placeholder="Buscar usuários">
                                </div>
                            </div>
                            <button id="servicesTableDropdownDefault" data-dropdown-toggle="servicesTableDropdown"
                                class="h-[42px] mb-4 sm:mb-0 mr-4 inline-flex items-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-4 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
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
                                        <input name="filter" type="checkbox" value="active"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            wire:change="filterUsers('active')"
                                            @if (in_array('active', $filter)) checked @endif>

                                        <div class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Ativo
                                        </div>
                                    </li>

                                    <li class="flex items-center">
                                        <input name="filter" type="checkbox" value="inactive"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            wire:change="filterUsers('inactive')"
                                            @if (in_array('inactive', $filter)) checked @endif>

                                        <div class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            Inativo
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex items-center">
                            @can('createUsers')
                                <button type="button" data-modal-target="add-user-modal" data-modal-toggle="add-user-modal"
                                    class="inline-flex items-center justify-center w-1/2 px-3 h-[42px] text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700">
                                    <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Adicionar usuário
                                </button>
                            @endcan

                            <button wire:loading wire:target='exportUsers' disabled type="button"
                                class="py-2.5 px-5 me-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center ml-4">
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

                            <button wire:loading.remove wire:click="exportUsers"
                                class="inline-flex items-center justify-center w-1/2 px-3 h-[42px] text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 sm:w-auto dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 ml-4">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Exportar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <p class="flex text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400 mb-4">
                {{ $exportMessage }} </p>
            @if (session('message'))
                <div class="flex text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400 mb-4"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Mensagem</span>
                    <ul>
                        @foreach (session('message') as $key => $msg)
                            <li>{{ $msg }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flex flex-col mt-5">
                <div class="overflow-x-auto rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden shadow sm:rounded-lg">
                            @if ($users->isNotEmpty())
                                <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-600">
                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Nome
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Cargo
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Avaliação
                                            </th>
                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Status
                                            </th>

                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                último acesso
                                            </th>

                                            <th scope="col"
                                                class="p-4 text-xs font-medium text-left text-gray-500 uppercase dark:text-gray-400">
                                                Ações
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr
                                                class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <td class="flex items-center p-4 mr-12 space-x-6 whitespace-nowrap">
                                                    @if ($user->avatar)
                                                        <img class="w-8 h-8 rounded-full"
                                                            src="{{ url('storage/' . $user->avatar->file) }}"
                                                            alt="{{ $user->avatar->name }}" />
                                                    @else
                                                        <svg class="bg-white text-gray-500 w-7 h-7 dark:bg-gray-300 rounded-full"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="currentColor" viewBox="0 0 24 24">
                                                            <path fill-rule="evenodd"
                                                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                    <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                        <div class="text-base font-semibold text-gray-900 dark:text-white">
                                                            {{ $user->name }}
                                                        </div>
                                                        <div class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                                            {{ $user->email }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="max-w-sm p-4 overflow-hidden text-base font-normal text-gray-500 truncate xl:max-w-xs dark:text-gray-400">
                                                    <span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-3 py-1 rounded-full dark:bg-blue-900 dark:text-blue-300">
                                                        {{ $user->getRoleNames()->first() ?? 'Nenhum' }}
                                                    </span>
                                                </td>
                                                <td
                                                    class="p-4 text-base font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center">
                                                        @for ($i = 0; $i < 5; $i++)
                                                            <svg aria-hidden="true"
                                                                class="w-5 h-5 {{ $i < $user->rating ? 'text-yellow-400' : 'text-gray-400' }}"
                                                                fill="currentColor" viewBox="0 0 20 20"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                            </svg>
                                                        @endfor
                                                        <span class="ml-1 text-gray-500 dark:text-gray-400">
                                                            {{ number_format($user->rating, 1) }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-4 text-base font-normal text-gray-900 whitespace-nowrap dark:text-white">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="h-2.5 w-2.5 rounded-full {{ $user->status->getStyles() }} mr-2">
                                                        </div> {{ $user->status->getName() }}
                                                    </div>
                                                </td>
                                                <td class="p-4 text-base text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $user->lastActivity() ? $user->lastActivity()->translatedFormat('d M y à\s\ H:i') : '-' }}
                                                </td>

                                                <td class="whitespace-nowrap">
                                                    @can('editUsers')
                                                        @if ($user)
                                                            <button type="button"
                                                                wire:click="loadUpdateUser({{ $user->id }})"
                                                                data-modal-target="edit-user-modal"
                                                                data-modal-toggle="edit-user-modal"
                                                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center rounded-lg text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-600">
                                                                <svg class="w-4 h-4 mr-2" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                                    </path>
                                                                    <path fill-rule="evenodd"
                                                                        d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                Editar
                                                            </button>
                                                        @endif
                                                    @endcan

                                                    @can('deleteUsers')
                                                        @if ($user)
                                                            <button type="button"
                                                                wire:click="loadDeleteUser({{ $user->id }})"
                                                                data-modal-target="delete-user-modal"
                                                                data-modal-toggle="delete-user-modal"
                                                                class="inline-flex items-center text-sm font-medium text-center text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                                                <svg class="w-4 h-4 mr-1" fill="currentColor"
                                                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                                Excluir
                                                            </button>
                                                        @endif
                                                    @endcan

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div>
                                    <p class="text-gray-500 dark:text-gray-400">Nenhum usuário encontrado.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <nav class="flex flex-col items-start justify-between p-4 space-y-3 md:flex-row md:items-center md:space-y-0"
                aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                    Mostrando
                    <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span>
                    de
                    <span class="font-semibold text-gray-900 dark:text-white">
                        {{ $users->total() }}
                    </span>
                </span>
                {{ $users->links('vendor.pagination.custom') }}
            </nav>

            @livewire('dashboard.modals.edit-user-modal')

            @livewire('dashboard.modals.add-user-modal')

            <!-- Delete User Modal -->
            <div class="fixed left-0 right-0 z-50 items-center justify-center overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full hidden"
                wire:ignore id="delete-user-modal" aria-hidden="true">
                <div class="relative w-full h-full max-w-md px-4 md:h-auto">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                        <!-- Modal header -->
                        <div class="flex justify-end p-2">
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                                data-modal-toggle="delete-user-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 pt-0 text-center">
                            <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Tem certeza que deseja excluir
                                este usuário?</h3>
                            <a wire:click="deleteUser()"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800 cursor-pointer">
                                Sim, tenho certeza
                            </a>
                            <a href="#"
                                class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                                data-modal-toggle="delete-user-modal">
                                Não, cancelar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Script -->
    <script>
        function loadAndShowModal() {
            // Chama o método Livewire para carregar os dados
            Livewire.dispatch('loadData');

            // Aguarda o evento 'data-loaded' emitido pelo Livewire
            window.addEventListener('data-loaded', () => {
                // Usa Flowbite para abrir o modal
                const modal = document.getElementById('dataModal');
                modal.classList.remove('hidden'); // Mostra o modal
            }, {
                once: true
            }); // Garante que o evento só é executado uma vez
        }
    </script>
</div>
