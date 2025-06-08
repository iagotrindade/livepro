<div class="mx-auto min-h-screen py-6 rounded-lg shadow-md">
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">
                Protocolo nº {{ $support->protocol }}
            </h1>
            <p class="text-sm text-gray-400 mb-6">Categoria: {{ $support->category->name }} •
                {{ $support->created_at->translatedFormat('D, h:i') . ' (' . $support->created_at->diffForHumans() . ')' }}
            </p>
        </div>

        <div class="flex items-center space-x-4">
            <span
                class="px-3 py-1 text-sm font-medium border {{ $support->priority->getStyles() }} rounded-full">
                Prioridade {{ $support->priority->getName() }}
            </span>
            @if ($support->status->getName() === 'Aberto')
                <button wire:click="assignTicket"
                    class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                    Atribuir-me
                </button>
            @elseif ($support->status->getName() === 'Fechado')
                <span
                    class="px-3 py-1 text-sm font-medium text-blue-800 bg-red-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
                    Fechado
                </span>
            @elseif ($support->status->getName() === 'Em andamento')
                <span
                    class="px-3 py-1 text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full dark:bg-yellow-900 dark:text-yellow-300">
                    Em andamento (Atribuído)
                </span>
            @elseif ($support->status->getName() === 'Resolvido')
                <span
                    class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                    Resolvido
                </span>
            @endif
        </div>
    </div>

    {{-- Message 1 - Client --}}
    <div class="bg-gray-50 dark:bg-gray-700 dark:border-gray-600 rounded-xl p-6 mb-6">
        <div class="flex items-center mb-4">
            @if ($support->user->avatar)
                <img class="w-10 h-10 rounded-full mr-3" src="{{ url('storage/' . $support->user->avatar->file) }}"
                    alt="{{ $support->user->avatar->name }}" />
            @else
                <img class="w-10 h-10 rounded-full mr-3" src="/storage/assets/images/avatars/default_user_avatar.png"
                    alt="Imagem do usuário" />
            @endif
            <div>
                <p class="text-gray-800 dark:text-white font-semibold">{{ $support->user->name }}</p>
                <p class="text-gray-400 text-sm">para Suporte - Livepro</p>
            </div>
        </div>
        <div class="text-gray-800 dark:text-gray-200 space-y-4 mb-4">
            <p>
                {{ $support->subject }}
            </p>
        </div>

        @if ($support->user_files)
            <div class="mt-4">
                <h3 class="text-gray-800 dark:text-white font-semibold mb-2">Arquivos anexados:</h3>
                <ul class="list-disc list-inside space-y-2">
                    <div
                        class="max-w-80 flex items-center p-3 mb-3.5 border border-gray-700  dark:border-gray-500 bo rounded-lg">
                        <div
                            class="max-w-40 flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                            <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6 dark:text-primary-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                    d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z" />
                            </svg>
                        </div>
                        <div class="mr-4">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ Str::of($support->user_files)->limit(20, '...') }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">ZIP</p>
                        </div>
                        <div class="flex items-center ml-auto">
                            <a href="{{ url('storage/support_files/' . $support->user_files) }}" target="_blank"
                                class="p-2 rounded hover:bg-gray-100">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z">
                                    </path>
                                </svg>

                                <span class="sr-only">Download</span>
                            </a>
                        </div>
                    </div>
                </ul>
            </div>
        @endif
    </div>

    {{-- Message 2 - Support --}}
    @if ($support->supportAgent && $support->resolution)
        <div class="bg-gray-200 dark:bg-gray-900 rounded-xl p-6 mb-6">
            <div class="flex items-center mb-4">
                @if ($support->supportAgent->avatar)
                    <img class="w-10 h-10 rounded-full mr-3"
                        src="{{ url('storage/' . $support->supportAgent->avatar->file) }}"
                        alt="{{ $support->supportAgent->avatar->name }}" />
                @else
                    <img class="w-10 h-10 rounded-full mr-3"
                        src="/storage/assets/images/avatars/default_user_avatar.png" alt="Imagem do usuário" />
                @endif
                <div>
                    <p class="text-gray-800 dark:text-white font-semibold">
                        {{ $support->supportAgent->name ?? 'Nome não informado' }}</p>
                    </p>
                    <p class="text-gray-400 text-sm">para {{ $support->user->name }}</p>
                </div>
            </div>
            <div class="text-gray-800 dark:text-gray-200 space-y-4 mb-4">
                <p>
                    {{ $support->resolution ?? 'Nenhuma resposta foi enviada ainda.' }}
                </p>
            </div>

            @if ($support->support_files)
                <div class="mt-4">
                    <h3 class="text-gray-800 dark:text-white font-semibold mb-2">Arquivos anexados:</h3>
                    <ul class="list-disc list-inside space-y-2">
                        <div
                            class="max-w-80 flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <div
                                class="max-w-40 flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                                <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Zm-4 1h.01v.01H15V5Zm-2 2h.01v.01H13V7Zm2 2h.01v.01H15V9Zm-2 2h.01v.01H13V11Zm2 2h.01v.01H15V13Zm-2 2h.01v.01H13V15Zm2 2h.01v.01H15V17Zm-2 2h.01v.01H13V19Z" />
                                </svg>
                            </div>

                            <div class="mr-4">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ Str::of($support->support_files)->limit(20, '...') }}</p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">ZIP</p>
                            </div>

                            <div class="flex items-center ml-auto">
                                <a href="{{ url('storage/support_files/' . $support->support_files) }}" target="_blank"
                                    class="p-2 rounded hover:bg-gray-100">
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z">
                                        </path>
                                    </svg>

                                    <span class="sr-only">Download</span>
                                </a>
                            </div>
                        </div>
                    </ul>
                </div>
            @endif
        </div>
    @endif

    @if (!$support->resolution)
        {{-- Area de Resposta --}}
        <div class="bg-gray-200 dark:bg-gray-900 rounded-xl p-6 mb-6">
            <p class="text-gray-800 dark:text-white font-semibold">Aguardando resposta do suporte...</p>
        </div>

        <form wire:submit.prevent="sendResponse" enctype="multipart/form-data">
            <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                <div class="flex items-center justify-between px-3 py-2 border-b border-gray-200 dark:border-gray-600 ">

                    {{-- select de status do ticket --}}
                    <div class="flex items justify-between py-2 border-gray-200 dark:border-gray-600">
                        <div class="flex items justify-between w-full">
                            <select id="status" wire:model="status" wire:change="updateStatus"
                                wire:confirm="Você tem certeza que deseja alterar o status do ticket?"
                                class="block w-full px-3 py-2 mt-1 text-sm text-gray-800 bg-white border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="open">Aberto</option>
                                <option value="closed">Fechado</option>
                                <option value="in_progress">Em andamento (Atribuído)</option>
                                <option value="resolved">Resolvido</option>
                            </select>
                        </div>
                    </div>

                    <div
                        class="flex flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                        <div class="flex items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                            <button type="button" onclick="document.getElementById('files').click()"
                                class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 12 20">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                                        d="M1 6v8a5 5 0 1 0 10 0V4.5a3.5 3.5 0 1 0-7 0V13a2 2 0 0 0 4 0V6" />
                                </svg>
                                <span class="sr-only">Adicionar Arquivos</span>
                            </button>
                            <button type="button" onclick="document.getElementById('files').click()"
                                class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 20">
                                    <path
                                        d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                </svg>
                                <span class="sr-only">Enviar Imagem</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-12 bg-white rounded-b-lg dark:bg-gray-800">
                    <input type="file" name="files[]" id="files" multiple style="margin: -2000px;"
                        wire:model="files" />
                    <label for="support-response" class="sr-only">Enviar resposta</label>
                    <textarea id="support-response" rows="8" name="resolution" wire:model="resolution"
                        class="block w-full px-0 text-sm text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                        placeholder="Digite sua resposta..." required></textarea>

                    <div class="flex flex-wrap items-center gap-4 mt-4">
                        @foreach ($filesData as $index => $file)
                            <div
                                class="max-w-60 flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <div
                                    class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                                    <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                        fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                        aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625zM7.5 15a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5A.75.75 0 017.5 15zm.75 2.25a.75.75 0 000 1.5H12a.75.75 0 000-1.5H8.25z">
                                        </path>
                                        <path
                                            d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="mr-4">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ Str::of($file['originalName'])->limit(15, '...') }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $file['extension'] }},
                                        {{ $file['size'] }}Mb</p>
                                </div>

                                <div class="flex items-center ml-auto">
                                    <button type="button" class="p-2 rounded"
                                        wire:click="removeFile({{ $index }})">
                                        <svg wire:click="removeFile({{ $index }})"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"
                                            class="w-5 h-5 text-gray-500 dark:text-red-500">

                                            <path
                                                d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                        </svg>

                                        <span class="sr-only">Remover arquivo</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit"
                    class="mx-4 my-4 inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                    Enviar resposta
                </button>
            </div>
        </form>
    @else
        {{-- Mostrar quando já tiver sido respondido --}}
        <div class="flex flex-col items-center justify-center h-full">
            <svg class="w-16 h-16 text-gray-800 dark:text-white" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                viewBox="0 0 24 24">
                <path fill-rule="evenodd"
                    d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                    clip-rule="evenodd"></path>
            </svg>

            <p class="mt-2 text-lm text-gray-500 dark:text-gray-400">Ticket Respondido por
                {{ $support->supportAgent->name }} em {{ $support->updated_at->format('d/m/Y \à\s H:i') }}</p>
        </div>
    @endif
</div>
