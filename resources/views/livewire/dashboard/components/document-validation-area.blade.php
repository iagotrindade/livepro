<div class="min-h-screen bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6">
    <div class="flex items-center justify-between mb-2">
        <div>
            <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Documentos do Profissional
                {{ $documents[0]->user->name }}
            </h2>

            <p class="text-sm text-gray-400 mb-6">Enviado em •
                {{ $documents[0]->created_at->translatedFormat('D, h:i') . ' (' . $documents[0]->created_at->diffForHumans() . ')' }}
            </p>
        </div>

        <div class="flex items-center space-x-4">
            @if (
                $documents[0]->documentValidation->status->getName() == 'Pendente' ||
                    $documents[0]->documentValidation->status->getName() == 'Em andamento' ||
                    $documents[0]->documentValidation->status->getName() == 'Em recurso')
                <span
                    class="{{ $documents[0]->documentValidation->status->getStyles() }} mr-2 px-3 py-1 text-sm text-center font-medium rounded-full">
                    {{ $documents[0]->documentValidation->status->getName() }} (Atribuido)
                </span>
            @endif

            @if ($documents[0]->documentValidation->status->getName() == 'Pendente')
                <button wire:click="assignValidation({{ $documents[0]->user_id }})"
                    class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
                    Atribuir-me
                </button>
            @endif
        </div>
    </div>
    <div>
        @csrf
        @error('justification')
            <p class="mb-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
        @enderror

        @if (session('message'))
            <p class="mb-2 text-sm text-blue-600 dark:text-blue-400"> {{ session('message') }}</p>
        @endif

        <table class="min-w-full mb-6">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Documento</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Obrigatório</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Arquivo</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Validação</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Justificativa
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($documents as $document)
                    <tr class="bg-gray-50 dark:bg-gray-800 dark:border-gray-600 rounded-xl border-b">
                        <td class="flex items-center px-4 py-2 font-semibold text-gray-800 dark:text-white">
                            <p class="mr-2">
                                {{ $document->document->name }}
                            </p>

                            @if ($document->documentValidation->status->getName() == 'Validado')
                                <svg class="w-8 h-8 text-green-400 dark:text-green-700" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            @elseif ($document->documentValidation->status->getName() == 'Invalidado')
                                <svg class="w-8 h-8 text-red-400 dark:text-red-800" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M12 9v3m0 4h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            @endif
                        </td>

                        <td class="px-4 py-2">
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ $document->document->type->getName() }}
                            </p>
                        </td>

                        <td class="px-4 py-2">
                            <p class="text-gray-600 dark:text-gray-300">
                                {{ $document->document->is_mandatory ? 'Sim' : 'Não' }}
                            </p>
                        </td>

                        <td class="px-4 py-2">
                            <a href="{{ url('storage/professional_docs/' . $document->folder_path) }}" target="_blank"
                                class="text-blue-600 underline">Visualizar</a>
                        </td>

                        <td class="px-4 py-2 flex">
                            <svg class="cursor-pointer inline-flex items-center mr-2 w-10 h-10 text-green-400 dark:text-green-600"
                                wire:click='evaluateDocument({{ $document->documentValidation->id }}, "validated")'
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M15.03 9.684h3.965c.322 0 .64.08.925.232.286.153.532.374.717.645a2.109 2.109 0 0 1 .242 1.883l-2.36 7.201c-.288.814-.48 1.355-1.884 1.355-2.072 0-4.276-.677-6.157-1.256-.472-.145-.924-.284-1.348-.404h-.115V9.478a25.485 25.485 0 0 0 4.238-5.514 1.8 1.8 0 0 1 .901-.83 1.74 1.74 0 0 1 1.21-.048c.396.13.736.397.96.757.225.36.32.788.269 1.211l-1.562 4.63ZM4.177 10H7v8a2 2 0 1 1-4 0v-6.823C3 10.527 3.527 10 4.176 10Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <svg class="cursor-pointer w-10 h-10 text-red-400 dark:text-red-800"
                                wire:click='evaluateDocument({{ $document->documentValidation->id }}, "invalidated")'
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8.97 14.316H5.004c-.322 0-.64-.08-.925-.232a2.022 2.022 0 0 1-.717-.645 2.108 2.108 0 0 1-.242-1.883l2.36-7.201C5.769 3.54 5.96 3 7.365 3c2.072 0 4.276.678 6.156 1.256.473.145.925.284 1.35.404h.114v9.862a25.485 25.485 0 0 0-4.238 5.514c-.197.376-.516.67-.901.83a1.74 1.74 0 0 1-1.21.048 1.79 1.79 0 0 1-.96-.757 1.867 1.867 0 0 1-.269-1.211l1.562-4.63ZM19.822 14H17V6a2 2 0 1 1 4 0v6.823c0 .65-.527 1.177-1.177 1.177Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </td>
                        <td class="px-4 py-2">
                            <textarea rows="1" wire:model.defer="justifications.{{ $document->documentValidation->id }}"
                                name="justification[{{ $document->documentValidation->id }}]"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Obrigatório se recusar..."></textarea>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-start">
            <button wire:click="finalizeValidation({{ $documents[0]->user->id }})"
                class="font-semibold px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Finalizar Validação
            </button>
        </div>
    </div>
</div>
