<div>
    <!-- EDIT ROLE -->
    @can('editPermissions')
        <div id="drawer-update-permission-default" x-data="{ isOpen: @entangle('isDrawerOpen') }" x-show="isOpen"
            @keydown.escape.window="isOpen = false"
            class="fixed top-0 left-0 z-40 w-full h-screen max-w-[400px] p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800 mt-16 pb-16"
            tabindex="-1" aria-labelledby="drawer-label" aria-hidden="true">

            <h5 id="drawer-label"
                class="inline-flex items-center mb-6 text-sm font-semibold text-gray-500 uppercase dark:text-gray-400">
                Editando {{ $updatedRole->name }}</h5>
            <button type="button" data-drawer-dismiss="drawer-update-permission-default"
                aria-controls="drawer-update-permission-default"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Fechar</span>
            </button>

            <div class="flex flex-col">
                <div class="mb-5">
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
                    <input type="text" wire:model.blur="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                @foreach ($areas as $area => $permissions)
                    <div
                        class="flex flex-col bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 p-2.5 rounded-lg mb-5">
                        <p class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Área
                            {{ ucfirst($area) }}
                        </p>
                        @foreach ($permissions as $permission)
                            <label class="inline-flex items-center cursor-pointer mb-5">
                                <input type="checkbox" value="{{ $permission }}"
                                    @if (in_array($permission, $updatedRole->permissions->pluck('name')->toArray())) checked @endif class="sr-only peer">
                                @php
                                    $permissionKey = $permission; // Gera a chave da permissão
                                @endphp
                                <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-800 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                                    wire:click="updateRole('{{ $permissionKey }}')">
                                </div>
                                <span
                                    class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ ucfirst($permission) }}</span>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Delete User Modal -->
        <div class="fixed left-0 right-0 z-50 items-center justify-center overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full hidden"
            id="delete-permission-modal" aria-hidden="true"
            wire:ignore>
            <div class="relative w-full h-full max-w-md px-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="delete-permission-modal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6 pt-0 text-center">
                        <svg class="w-16 h-16 mx-auto text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Tem certeza que deseja excluir este grupo?</h3>
                        <a wire:click="deleteRole()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800">
                            Sim, tenho certeza
                        </a>
                        <a href="#"
                            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                            data-modal-toggle="delete-permission-modal">
                            Não, cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endcan
</div>
