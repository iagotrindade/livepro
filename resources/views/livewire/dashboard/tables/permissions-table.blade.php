<div>
    <div class="w-full rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
        <!-- Card header -->
        <div class="items-center justify-between lg:flex">
            <div class="mb-4 lg:mb-0">
                <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Permissões do Sistema</h3>
                <span class="text-base font-normal text-gray-500 dark:text-gray-400">Total de usuários com permissões:
                    {{ $count }}</span>
            </div>
            <div class="items-center sm:flex">
                <div class="flex items-center">
                    @can('editPermissions')
                        <button type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            id="createPermissionButton" data-drawer-target="drawer-create-permission-default"
                            data-drawer-show="drawer-create-permission-default"
                            aria-controls="drawer-create-permission-default">
                            <svg class="w-5 h-5 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>

                            Criar Grupo
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        @error('name')
            <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Atenção</span>

                <span class="font-medium"> {{ $message }}</span>
            </div>
        @enderror

        @if (session('message'))
            <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Atenção</span>

                <span class="font-medium"> {{ session('message') }}</span>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-yellow-400 bg-green-400 bg-orange-400 bg-red-400"></div>
        <div class="flex flex-col mt-6">
            <div class="overflow-x-auto rounded-lg">
                <div class="inline-block min-w-full align-middle">
                    <div class="overflow-hidden shadow sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Grupo
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Usuários
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Data de criação
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        última atualização
                                    </th>
                                    <th scope="col"
                                        class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-4 py-2">
                                            {{ $role->name }}
                                        </td>

                                        <td
                                            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $role->users->count() }}
                                        </td>

                                        <td class="px-4 py-2">
                                            <span class="">
                                                {{ $role->created_at ? Str::upper($role->created_at->translatedFormat('d M y')) : '-' }}
                                            </span>
                                        </td>

                                        <td class="px-4 py-2">
                                            <span class="">
                                                {{ $role->updated_at ? Str::upper($role->updated_at->translatedFormat('d M y')) : '-' }}
                                            </span>
                                        </td>

                                        @can('editPermissions')
                                            <td class="py-4 whitespace-nowrap">
                                                <button id="updatePermissionButton"
                                                    wire:click="loadUpdateRole({{ $role->id }})"
                                                    data-drawer-target="drawer-update-permission-default"
                                                    data-drawer-show="drawer-update-permission-default"
                                                    aria-controls="drawer-update-permission-default"
                                                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center rounded-lg text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-600">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z">
                                                        </path>
                                                        <path fill-rule="evenodd"
                                                            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Editar
                                                </button>

                                                @can('deletePermissions')
                                                    <button type="button" wire:click="prepareDeleteRole( {{ $role->id }} )"
                                                        data-modal-target="delete-permission-modal"
                                                        data-modal-toggle="delete-permission-modal"
                                                        class="inline-flex items-center text-sm font-medium text-center text-red-600 hover:text-red-700 dark:text-red-500 dark:hover:text-red-600">
                                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd"
                                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                clip-rule="evenodd"></path>
                                                        </svg>
                                                        Excluir
                                                    </button>
                                                @endcan
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <livewire:dashboard.drawers.edit-permission-drawer />

    <!-- ADD NEW GROUP -->
    <div id="drawer-create-permission-default"
        class="fixed top-0 left-0 z-40 w-full h-screen max-w-[400px] p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800 mt-16 pb-16"
        tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
            Criando novo Grupo</h5>
        <button type="button" data-drawer-dismiss="drawer-create-permission-default"
            aria-controls="drawer-create-permission-default"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Fechar</span>
        </button>

        @can('editPermissions')
            <form class="flex flex-col" wire:submit="save">
                <div class="mb-5">
                    <label for="permissions_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome
                        da Permissão</label>
                    <input type="text" wire:model="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                </div>

                @foreach ($areas as $area => $permissions)
                    <div
                        class="flex flex-col bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 p-2.5 rounded-lg mb-5">
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Área {{ ucfirst($area) }}
                        </p>
                        @foreach ($permissions as $permission)
                            <label class="inline-flex items-center cursor-pointer mb-5">
                                <input type="checkbox" value="{{ $permission }}" wire:model="permissions"
                                    class="sr-only peer">
                                <div
                                    class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ ucfirst($permission) }}</span>
                            </label>
                        @endforeach
                    </div>
                @endforeach

                <div class="flex justify-center w-full pb-4 mt-4">
                    <button type="submit"
                        class="w-full justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Criar
                    </button>
                </div>
            </form>
        @endcan
    </div>
</div>
