<div class="p-4 w-full bg-white rounded-lg shadow dark:bg-gray-800 sm:p-6 h-full">
    <h3 class="flex items-center mb-4 text-lg font-semibold text-gray-900 dark:text-white">Usuários com Permissões
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
            <h3 class="font-semibold text-gray-900 dark:text-white">Usuários com Permissões</h3>
            <p>Os usuários abaixo possuem algum tipo de permissão que lhe da acesso a determinadas áreas dentro do
                sistema.</p>
        </div>
        <div style="position: absolute; left: 0px; transform: translate(271px, 0px);"></div>
    </div>

    <div class="border-t border-gray-200 dark:border-gray-600">
        <div class="pt-4">
            <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                @if (!empty($users))
                    @foreach ($users as $user)
                        <li class="py-3 sm:py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    <a href="">
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
                                    </a>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-900 truncate dark:text-white">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <div
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">

                                    <select wire:confirm="Tem certeza que deseja alterar o grupo de {{ $user->name }}"
                                        wire:change="changeUserPermission($event.target.value, {{ $user->id }})"
                                        class="h-9 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Alterar Permissão</option>
                                        @foreach ($roles as $role)
                                            <option @if ($user->hasRole($role->name)) selected @endif>
                                                {{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
</div>
