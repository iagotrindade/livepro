<div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
    <!-- Left Content -->
    <div class="col-span-full xl:col-auto">
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">

            @error('avatar')
                <div class="flex mb-3 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
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
            <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
                <div class="relative">
                    <div wire:loading.flex wire:target="avatar"
                        class="absolute rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 inset-0 flex items-center justify-center">
                        <div role="status">
                            <svg aria-hidden="true"
                                class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor" />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill" />
                            </svg>
                            <span class="sr-only">Carregando...</span>
                        </div>
                    </div>

                    @if ($user->avatar)
                        <img class="rounded-lg w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0"
                            src="{{ url('storage/' . $user->avatar->file) }}" alt="{{ $user->avatar->name }}" />
                    @else
                        <svg class="rounded-lg w-28 h-28 dark:bg-gray-300" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif
                </div>
                <div>
                    <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Foto de perfil
                    </h3>
                    <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                        JPG, GIF or PNG.
                    </div>
                    <input type="file" wire:model="avatar" id="avatar" style="position: fixed; top: -100em">
                    <div class="flex items-center space-x-4">
                        <button type="button" onclick="document.getElementById('avatar').click()"
                            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z">
                                </path>
                                <path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path>
                            </svg>
                            Enviar imagem
                        </button>
                        @if ($user->avatar)
                            <button wire:confirm="Deseja realmente excluir sua foto de perfil" wire:click="deleteAvatar"
                                type="button"
                                class="py-2 px-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                Excluir
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">Status &amp; Cargo</h3>
            <div class="mb-4">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Status atual
                </label>
                <div class="flex items-center" id="status">
                    <div class="h-2.5 w-2.5 rounded-full mr-2 {{ $user->status->getStyles() }}"></div>
                    <p class="text-gray-900 whitespace-nowrap dark:text-white">Ativo</p>
                </div>
            </div>

            <div class="mb-4">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Avaliação: {{ number_format($user->rating, 1) }}
                </label>
                <dl>
                    <dt class="sr-only">Estrelas:</dt>
                    <dd class="flex items-center space-x-1">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 {{ $i < $user->rating ? 'text-yellow-400' : 'text-gray-400' }}""
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path
                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                </path>
                            </svg>
                        @endfor
                    </dd>
                </dl>
            </div>

            <div class="mb-6">
                @if (session('permissionMessage'))
                    <div class="flex mb-2 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Atenção</span>

                        <span class="font-medium"> {{ session('permissionMessage') }} </span>
                    </div>
                @endif
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Função/Cargo
                </label>
                <select id="userRole" name="userRole" wire:model="userRole"
                    @if ($user->cannot('editPermissions')) disabled @endif
                    class="bg-gray-50 border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach ($roles as $role)
                        <option>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @can('editPermissions')
                <div class="col-span-6 sm:col-full" data-modal-target="change-permission-modal"
                    data-modal-toggle="change-permission-modal">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="submit">Salvar</button>
                </div>
            @endcan
        </div>
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <div class="flow-root">
                <h3 class="text-xl font-semibold dark:text-white">Sessões</h3>
                @if (session('sessionMessage'))
                    <div class="flex mt-2 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Atenção</span>

                        <span class="font-medium"> {{ session('sessionMessage') }}</span>
                    </div>
                @endif
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($userSessions as $session)
                        <li class="py-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex-shrink-0">
                                    {!! $session['device_icon'] !!}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-base font-semibold text-gray-900 truncate dark:text-white">
                                        {{ $session['country'] . ' - ' . $session['city'] . ' ' . $session['ip_address'] }}
                                    </p>
                                    <p class="text-sm font-normal text-gray-500 truncate dark:text-gray-400">
                                        {{ $session['platform'] }}
                                    </p>
                                </div>
                                <div class="inline-flex items-center">
                                    <button data-modal-target="revoke-session-modal"
                                        data-modal-toggle="revoke-session-modal"
                                        wire:click="prepareRevokeSession('{{ $session['id'] }}')"
                                        class="cursor-pointer px-3 py-2 mb-3 mr-3 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-blue-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                        Revogar
                                    </button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0">
            <div class="flow-root">
                <h3 class="text-xl font-semibold dark:text-white">Alertas &amp; Notificações</h3>
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Você pode escolher
                    quais
                    notificações deseja receber</p>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <!-- Item 1 -->
                    <div class="flex items-center justify-between py-4">
                        <div class="flex flex-col flex-grow">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                NewsLetter
                            </div>
                            <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                Receba a Newsletter LivePRO gratuitamente em seu email
                            </div>
                        </div>
                        <label for="company-news" class="relative flex items-center cursor-pointer">
                            <input wire:change="changeNotificationPreferences('newsletter')" type="checkbox"
                                id="company-news" class="sr-only"
                                {{ $user->notificationPreferences->newsletter ?? false ? 'checked' : '' }}>
                            <span
                                class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                        </label>
                    </div>
                    <!-- Item 2 -->
                    <div class="flex items-center justify-between py-4">
                        <div class="flex flex-col flex-grow">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                Atividade da conta
                            </div>
                            <div class="text-base font-normal text-gray-500 dark:text-gray-400">Receba
                                informações importantes sobre alterações e acessos em sua conta</div>
                        </div>
                        <label for="account-activity" class="relative flex items-center cursor-pointer">
                            <input wire:change="changeNotificationPreferences('account_activity')" type="checkbox"
                                id="account-activity" class="sr-only"
                                {{ $user->notificationPreferences->account_activity ?? false ? 'checked' : '' }}>
                            <span
                                class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                        </label>
                    </div>
                    <!-- Item 3 -->
                    <div class="flex items-center justify-between pt-4">
                        <div class="flex flex-col flex-grow">
                            <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                Novas mensagens
                            </div>
                            <div class="text-base font-normal text-gray-500 dark:text-gray-400">Receba
                                alertas de novas mensagens encaminhadas a você</div>
                        </div>
                        <label for="new-messages" class="relative flex items-center cursor-pointer">
                            <input wire:change="changeNotificationPreferences('new_messages')" type="checkbox"
                                id="new-messages" class="sr-only"
                                {{ $user->notificationPreferences->new_messages ?? false ? 'checked' : '' }}>
                            <span
                                class="h-6 bg-gray-200 border border-gray-200 rounded-full w-11 toggle-bg dark:bg-gray-700 dark:border-gray-600"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Content -->
    <div class="col-span-2">
        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            <h3 class="mb-4 text-xl font-semibold dark:text-white">Informações gerais</h3>

            <div class="relative">
                <div wire:loading.flex wire:target="saveGeneralData"
                    class="absolute rounded-lg w-full h-full inset-0 flex items-center justify-center mt-[-80px]">
                    <div role="status">
                        <svg aria-hidden="true"
                            class="w-16 h-16 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Carregando...</span>
                    </div>
                </div>

                @if (session('generalDataMessage'))
                    <div class="flex mb-2 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Atenção</span>

                        <span class="font-medium"> {{ session('generalDataMessage') }}</span>
                    </div>
                @endif

                @if ($errors->hasAny(['name', 'cpf_cnpj', 'email', 'phone', 'birthdate', 'biography']))
                    <div class="flex mb-3 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                        role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                        </svg>
                        <span class="sr-only">Atenção</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="font-medium"> {{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>
                @endif
                <form wire:submit="saveGeneralData">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-3">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Nome
                            </label>
                            <input wire:model.blur="name" type="text" name="name" id="name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Bonnie" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="cpf_cnpj"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                CPF/CNPJ
                            </label>
                            <input wire:model.blur="cpf_cnpj" type="text" name="cpf_cnpj" id="cpf_cnpj"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="000.000.000-00" required="">
                        </div>

                        <div class="col-span-6 sm:col-span-3">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input wire:model.blur="email" type="email" name="email" id="email"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="example@livepro.com" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone-number"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Número de telefone
                            </label>
                            <input wire:model.blur="phone" type="text" name="phone-number" id="phone-number"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="(51) 9-9999-9999" required="">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="birthday"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Aniversário</label>
                            <input wire:model="birthdate" type="text" name="birthday" id="birthday"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Ex: 15/08/1990">
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <label for="memberSince"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Membro</label>
                            <input wire:model="memberSince" type="text" name="memberSince" id="disabled-input"
                                aria-label="disabled input" disabled
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 cursor-not-allowed">
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label for="bio"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Biografia</label>

                            <textarea wire:model="biography" id="bio" rows="8"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Nos conte mais sobre você..."></textarea>
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <button
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                type="submit">Salvar tudo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div
            class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm 2xl:col-span-2 dark:border-gray-700 sm:p-6 dark:bg-gray-800 relative">
            <div wire:loading.flex wire:target="changePassword"
                class="absolute rounded-lg w-full h-full inset-0 flex items-center justify-center">
                <div role="status">
                    <svg aria-hidden="true"
                        class="w-12 h-12 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                    <span class="sr-only">Carregando...</span>
                </div>
            </div>
            <h3 class="mb-4 text-xl font-semibold dark:text-white">Alteração de senha</h3>

            @if (session('passwordMessage'))
                <div class="flex mb-2 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Atenção</span>

                    <span class="font-medium"> {{ session('passwordMessage') }}</span>
                </div>
            @endif

            @if ($errors->hasAny(['current_password', 'password', 'password_confirmation']))
                <div class="flex mb-3 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Atenção</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="font-medium"> {{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif
            <form wire:submit="changePassword">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-3">
                        <label for="current-password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Senha atual
                        </label>
                        <input wire:model="current_password" type="password" name="current-password"
                            id="current-password"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="••••••••">
                    </div>
                    <div class="col-span-6 sm:col-span-3 relative">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Nova senha
                        </label>
                        <input wire:model.live="password" type="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="••••••••">
                        @if (strlen($password) >= 1)
                            <div class="absolute z-10 inline-block text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-100 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                                style="top: 120%; left: 200px;">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Deve ter no mínimo 8
                                        caracteres</h3>

                                    <!-- Indicadores de força -->
                                    <div class="grid grid-cols-4 gap-2">
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div
                                                class="h-1
                            {{ $i <= $newPasswordRules['length']
                                ? ($newPasswordRules['length'] >= 4
                                    ? 'bg-green-300 dark:bg-green-400'
                                    : 'bg-orange-300 dark:bg-orange-400')
                                : 'bg-gray-200 dark:bg-gray-600' }}">
                                            </div>
                                        @endfor
                                    </div>

                                    <p>É melhor que tenha:</p>

                                    <!-- Lista de critérios -->
                                    <ul>
                                        <li class="flex items-center mb-1">
                                            <svg class="w-4 h-4 mr-2 {{ $newPasswordRules['uppercase'] && $newPasswordRules['lowercase'] ? 'text-green-400 dark:text-green-500' : 'text-gray-300 dark:text-gray-400' }}"
                                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Letras Maiúsculas &amp; minúsculas
                                        </li>
                                        <li class="flex items-center mb-1">
                                            <svg class="w-4 h-4 mr-2 {{ $newPasswordRules['symbols'] ? 'text-green-400 dark:text-green-500' : 'text-gray-300 dark:text-gray-400' }}"
                                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Um símbolo (#$&)
                                        </li>
                                        <li class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 {{ $newPasswordRules['recommended_length'] ? 'text-green-400 dark:text-green-500' : 'text-gray-300 dark:text-gray-400' }}"
                                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Uma senha longa (min. 12 caracteres.)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-span-6 sm:col-span-3">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmar
                            senha</label>
                        <input wire:model.blur="password_confirmation" type="password" name="password_confirmation"
                            id="password_confirmation"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="••••••••">
                    </div>
                    <div class="col-span-6 sm:col-full">
                        <button
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="submit">Salvar tudo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Full Bottom Content -->
    <div
        class="bg-green-100 text-green-800 dark:bg-green-400 dark:text-green-400 border-green-500 bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 border-gray-500 bg-yellow-100 text-yellow-800 dark:bg-yellow-400 dark:text-yellow-400 border-yellow-500 bg-red-100 text-red-800 dark:bg-red-400 dark:text-red-400 border-red-500">
    </div>
    <div
        class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0 col-span-full">
        <div class="flow-root">
            <h3 class="text-xl font-semibold dark:text-white">Avaliações &amp; Comentários</h3>
            <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Veja as notas e comentários
                que os clientes fizeram sobre seus serviços</p>

            @if (session('reviewMessage'))
                <div class="flex mt-3 text-sm text-blue-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-blue-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Atenção</span>

                    <span class="font-medium"> {{ session('reviewMessage') }}</span>
                </div>
            @endif

            @if ($errors->hasAny(['disputeReason']))
                <div class="flex mt-3 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Atenção</span>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="font-medium"> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                <!-- Item 1 -->
                @foreach ($user->reviews as $review)
                    <div class="flex items-center justify-between py-4">
                        <div class="flex flex-col flex-grow">
                            <p class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Avaliação:
                                {{ number_format($review->rating, 1) }}</p>
                            <div class="items-center text-lg font-semibold text-gray-900 dark:text-white mb-1">
                                <dl class="mr-3">
                                    <dt class="sr-only">Estrelas:</dt>
                                    <dd class="flex items-center space-x-1">
                                        @for ($i = 0; $i < 5; $i++)
                                            <svg class="w-5 h-5 {{ $i < $review->rating ? 'text-yellow-400' : 'text-gray-400' }}"
                                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                                </path>
                                            </svg>
                                        @endfor
                                    </dd>
                                </dl>
                            </div>
                            <div class="max-w-content mb-1">
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500 ">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                    </svg>
                                    {{ $review->created_at->translatedFormat('d M Y') }}
                                </span>

                                <span
                                    class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border text-gray-800 dark:text-white {{ $review->status->getStyles() }}">
                                    {{ $review->status->getName() }}
                                </span>
                            </div>
                            <div class="text-base font-normal text-gray-500 dark:text-gray-400">
                                {{ $review->comment }}
                            </div>
                        </div>
                        @if ($review->status->getName() == 'Publicado')
                            <label for="company-news" class="relative flex items-center cursor-pointer">
                                <button data-modal-target="review-modal" data-modal-toggle="review-modal"
                                    wire:click="setDisputedReview({{ $review->id }})" type="button"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Solicitar
                                    revisão</button>
                            </label>
                        @else
                            <label for="company-news" class="relative flex items-center cursor-pointer">
                                <button type="button" data-modal-target="read-dispute-modal"
                                    data-modal-toggle="read-dispute-modal"
                                    wire:click="setDisputedReview({{ $review->id }})"
                                    class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Visualizar</button>
                            </label>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @can('editPermissions')
        <!-- Change Permission Modal -->
        <div class="fixed left-0 right-0 z-50 items-center justify-center overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full hidden"
            wire:ignore id="change-permission-modal" aria-hidden="true">
            <div class="relative w-full h-full max-w-md px-4 md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                    <!-- Modal header -->
                    <div class="flex justify-end p-2">
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-toggle="change-permission-modal">
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
                        <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">Tem certeza que deseja alterar seu
                            grupo de permissões?</h3>
                        <a wire:click="changePermission()"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800 cursor-pointer">
                            Sim, tenho certeza
                        </a>
                        <a href="#"
                            class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                            data-modal-toggle="change-permission-modal">
                            Não, cancelar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Revoke Session Modal -->
    <div class="fixed left-0 right-0 z-50 items-center justify-center overflow-x-hidden overflow-y-auto top-4 md:inset-0 h-modal sm:h-full hidden"
        wire:ignore id="revoke-session-modal" aria-hidden="true">
        <div class="relative w-full h-full max-w-md px-4 md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex justify-end p-2">
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                        data-modal-toggle="revoke-session-modal">
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
                    <h3 class="mt-5 mb-6 text-lg text-gray-500 dark:text-gray-400">O dispositivo será desconectado.
                        Deseja continuar?</h3>
                    <a wire:click="revokeSession()"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-base inline-flex items-center px-3 py-2.5 text-center mr-2 dark:focus:ring-red-800 cursor-pointer">
                        Sim, tenho certeza
                    </a>
                    <a href="#"
                        class="text-gray-900 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 border border-gray-200 font-medium inline-flex items-center rounded-lg text-base px-3 py-2.5 text-center dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                        data-modal-toggle="revoke-session-modal">
                        Não, cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Review Modal -->
    <div wire:ignore id="review-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        Solicitar revisão de avaliação
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="review-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Fechar</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form wire:submit="disputReview()" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-2">
                            <label for="description"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição da
                                solicitação</label>
                            <textarea wire:model="disputeReason" id="description" rows="8"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Descreva a motivação desta solicitação. No mínimo 50 caracteres..."></textarea>
                        </div>
                    </div>
                    <button type="submit" data-modal-toggle="review-modal"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Enviar para Análise
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Dispute modal -->
    <div wire:ignore.self id="read-dispute-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
        <div class="relative p-4 w-full max-w-4xl h-full md:h-auto ">

            <!-- Modal content -->
            <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5 ">
                <div wire:loading.flex wire:target="setDisputedReview"
                    class="rounded-lg w-full h-48 sm:mb-0 xl:mb-4 2xl:mb-0 inset-0 flex items-center justify-center">
                    <div role="status">
                        <svg aria-hidden="true"
                            class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Carregando...</span>
                    </div>
                </div>
                <!-- Modal header -->
                <div class="flex justify-between mb-4 rounded-t sm:mb-5" wire:loading.remove>
                    <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                        <h3 class="font-semibold mb-3">
                            Resumo da avaliação
                        </h3>

                        <dl class="mb-3">
                            <dt class="sr-only">Estrelas:</dt>
                            <dd class="flex items-center space-x-1">
                                @if ($disputedReview)
                                    @for ($i = 0; $i < 5; $i++)
                                        <svg class="w-5 h-5 {{ $i < $disputedReview->rating ? 'text-yellow-400' : 'text-gray-400' }}"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z">
                                            </path>
                                        </svg>
                                    @endfor
                                @endif
                            </dd>
                        </dl>

                        <div class="max-w-content mb-1">
                            @if ($disputedReview)
                                <span
                                    class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500 ">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                    </svg>
                                    {{ $disputedReview->created_at->translatedFormat('d M Y') }}
                                </span>
                            @endif

                            @if ($disputedReview)
                                <span
                                    class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border text-gray-800 dark:text-white {{ $review->status->getStyles() }}">
                                    {{ $disputedReview->status->getName() }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="read-dispute-modal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Fechar</span>
                        </button>
                    </div>
                </div>

                <div wire:loading.remove>
                    @if ($disputedReview)
                        <dl>
                            <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                {{ $disputedReview->comment }}
                            </dd>
                        </dl>

                        @if ($disputedReview->dispute)
                            <div class="mb-4 rounded-t sm:mb-5 ">
                                <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                                    <h3 class="font-semibold mb-3">
                                        Resumo da revisão
                                    </h3>

                                    <div class="max-w-content mb-3">
                                        <span
                                            class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500 ">
                                            <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                viewBox="0 0 20 20">
                                                <path
                                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                                            </svg>
                                            {{ $disputedReview->dispute->created_at->translatedFormat('d M Y') }}
                                        </span>

                                        <span
                                            class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border text-gray-800 dark:text-white {{ $disputedReview->dispute->status->getStyles() }}">
                                            {{ $disputedReview->dispute->status->getName() }}
                                        </span>

                                        <span
                                            class="text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 border text-gray-800 dark:text-white {{ $disputedReview->dispute->status->getStyles() }}">
                                            {{ $disputedReview->dispute->result->getName() }}
                                        </span>
                                    </div>

                                    <h4 class="font-semibold mb-3">
                                        Sua solicitação
                                    </h4>

                                    <dl style="word-wrap: break-word;">
                                        <dd class="text-base mb-3 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $disputedReview->dispute->reason }}
                                        </dd>
                                    </dl>

                                    <h4 class="font-semibold mb-3">
                                        Resposta
                                    </h4>

                                    <dl style="word-wrap: break-word;">
                                        <dd class="text-base mb-3 font-light text-gray-500 sm:mb-5 dark:text-gray-400">
                                            {{ $disputedReview->dispute->response ?? 'Aguardando revisão...' }}
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
