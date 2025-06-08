<div
    class="text-gray-800 dark:text-white bg-white dark:bg-gray-800 p-4 rounded-lg border border-white dark:border-gray-700 ">
    <div class="grid grid-cols-5 lg:grid-cols-4 gap-6">
        <div class="col-span-4 lg:col-span-3 space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold mb-2">Configure e envie sua Neswletter</h1>
                    <p class="text-gray-400 mb-4">Preencha os detalhes da newsletter e envie para os assinantes ou
                        grupos selecionados.</p>
                </div>

                <div>
                    <button
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        <svg class="w-6 h-6 mr-2 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        Visualizar Newsletter
                    </button>
                </div>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium">Modelo</label>
                <select
                    class="w-full text-gray-800 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-500 focus:ring-0 dark:text-white dark:placeholder-gray-400 rounded-lg p-2"
                    wire:model="template">
                    <option value="">Selecione um modelo</option>
                    <option value="1">Divulgação</option>
                    <option value="2">Aviso/Informação</option>
                    <option value="3">Promoção</option>
                </select>
            </div>

            <div>
                <label class="block mb-2 text-sm font-medium">Assunto</label>
                <input type="text" placeholder="Escreva o assunto da newsletter" wire:model="subject"
                    class="w-full text-gray-800 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-500 focus:ring-0 dark:text-white dark:placeholder-gray-400 rounded-lg p-2" />
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Conteúdo</label>
                <form>
                    <input type="file" name="files[]" id="files" multiple class="hidden" wire:model="files" />
                    <div
                        class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600">
                        <div
                            class="flex items-center justify-between px-3 py-2 border-b border-gray-200 dark:border-gray-600">
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
                                        <span class="sr-only">Anexar Arquivo</span>
                                    </button>
                                    <button type="button" onclick="document.getElementById('files').click()"
                                        class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 16 20">
                                            <path
                                                d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2ZM10.5 6a1.5 1.5 0 1 1 0 2.999A1.5 1.5 0 0 1 10.5 6Zm2.221 10.515a1 1 0 0 1-.858.485h-8a1 1 0 0 1-.9-1.43L5.6 10.039a.978.978 0 0 1 .936-.57 1 1 0 0 1 .9.632l1.181 2.981.541-1a.945.945 0 0 1 .883-.522 1 1 0 0 1 .879.529l1.832 3.438a1 1 0 0 1-.031.988Z" />
                                            <path
                                                d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z" />
                                        </svg>
                                        <span class="sr-only">Enviar Imagem</span>
                                    </button>
                                    <button type="button"
                                        class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600">
                                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM13.5 6a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm-7 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm3.5 9.5A5.5 5.5 0 0 1 4.6 11h10.81A5.5 5.5 0 0 1 10 15.5Z" />
                                        </svg>
                                        <span class="sr-only">Add emoji</span>
                                    </button>
                                </div>
                            </div>
                            <div id="tooltip-fullscreen" role="tooltip"
                                class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip dark:bg-gray-700">
                                Show full screen
                                <div class="tooltip-arrow" data-popper-arrow></div>
                            </div>
                        </div>
                        <div class="px-4 py-2 bg-white rounded-b-lg dark:bg-gray-800 ">
                            <label for="editor" class="sr-only">Conteúdo</label>
                            <textarea id="editor" rows="10" cols="80" wire:model="content"
                                class="block w-full px-0 text-lg text-gray-800 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                                placeholder="Escreva o conteúdo da Newsletter" required></textarea>

                            <div class="flex flex-wrap items-center gap-4 mt-4">
                                @foreach ($filesData as $index => $file)
                                    <div
                                        class="max-w-60 flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
                                        <div
                                            class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                                            <svg class="w-5 h-5 text-blue-600 lg:w-6 lg:h-6 dark:text-primary-300"
                                                fill="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
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
                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                {{ $file['extension'] }},
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
                    </div>
                    <button wire:click="scheduleNewsletter"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                        Enviar aos Usuários
                    </button>
                </form>
            </div>
        </div>

        <div class="col-span-1 lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-2 mb-6 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h2 class="text-base font-semibold">Envio por grupos</h2>
                </div>

                <div class="flex flex-col gap-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" value class="sr-only peer" checked wire:model="groups.all">
                        <div
                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Todos ({{ App\Models\User::count() }})
                        </span>
                    </label>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer"
                            wire:model.live="groups.registered">
                        <div
                            class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Assinantes da
                            Neswletter (488)</span>
                    </label>

                    @foreach ($permissionGroups as $permissionGroup)
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer"
                                wire:model="groups['{{ $permissionGroup->name }}']">
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ Str::of($permissionGroup->name)->title() }}
                                ({{ App\Models\User::with('roles')->get()->filter(fn($user) => $user->roles->where('name', $permissionGroup->name)->toArray())->count() }})
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M12.512 8.72a2.46 2.46 0 0 1 3.479 0 2.461 2.461 0 0 1 0 3.479l-.004.005-1.094 1.08a.998.998 0 0 0-.194-.272l-3-3a1 1 0 0 0-.272-.193l1.085-1.1Zm-2.415 2.445L7.28 14.017a1 1 0 0 0-.289.702v2a1 1 0 0 0 1 1h2a1 1 0 0 0 .703-.288l2.851-2.816a.995.995 0 0 1-.26-.189l-3-3a.998.998 0 0 1-.19-.26Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M7 3a1 1 0 0 1 1 1v1h3V4a1 1 0 1 1 2 0v1h3V4a1 1 0 1 1 2 0v1h1a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h1V4a1 1 0 0 1 1-1Zm10.67 8H19v8H5v-8h3.855l.53-.537a1 1 0 0 1 .87-.285c.097.015.233.13.277.087.045-.043-.073-.18-.09-.276a1 1 0 0 1 .274-.873l1.09-1.104a3.46 3.46 0 0 1 4.892 0l.001.002A3.461 3.461 0 0 1 17.67 11Z"
                            clip-rule="evenodd" />
                    </svg>

                    <h2 class="text-base font-semibold">Agendamento</h2>
                </div>
                <div class="space-y-2">
                    <label class="block text-sm font-medium mb-1">Data de envio</label>
                    <input type="date" wire:model="scheduledDate" id="date"
                        class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-sm rounded-lg p-2.5 dark:text-white dark:placeholder-gray-400" />

                    <label class="block text-sm font-medium mb-1">Hora de envio</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="time" id="time" wire:model="scheduledTime"
                            class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                            min="09:00" max="18:00" value="00:00" required />
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-2 mb-4 border-b border-gray-200 dark:border-gray-700 pb-4">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path
                            d="M18.045 3.007 12.31 3a1.965 1.965 0 0 0-1.4.585l-7.33 7.394a2 2 0 0 0 0 2.805l6.573 6.631a1.957 1.957 0 0 0 1.4.585 1.965 1.965 0 0 0 1.4-.585l7.409-7.477A2 2 0 0 0 21 11.479v-5.5a2.972 2.972 0 0 0-2.955-2.972Zm-2.452 6.438a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                    </svg>

                    <h2 class="text-base font-semibold">Tags</h2>
                </div>
                <div class="flex flex-wrap gap-2 mb-3">
                    @foreach ($tags as $index => $tag)
                        <span type="button"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ $tag }}
                            <div class="font-bold cursor-pointer ml-1 text-red-500 px-2 py-1 rounded text-xs"
                                wire:click="removeTag('{{ $index }}')">
                                X
                            </div>
                        </span>
                    @endforeach

                </div>
                <div class="flex gap-2">
                    <input type="text" placeholder="Adicionar tag" wire:model="newTag"
                        class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" />
                    <button wire:click="addNewTag()" class="bg-blue-600 text-white px-4 rounded">Adicionar</button>
                </div>
            </div>
        </div>
    </div>
</div>
