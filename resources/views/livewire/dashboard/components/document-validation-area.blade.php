<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mt-6">
    <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-white">Documentos do Profissional para avaliação</h2>

    @if ($document->status->getName() === 'Aberto')
        <button wire:click="assignTicket"
            class="px-3 py-1 text-sm font-medium text-green-800 bg-green-100 rounded-full dark:bg-green-900 dark:text-green-300">
            Atribuir-me
        </button>
    @elseif ($support->status->getName() === 'Fechado')
        <span
            class="px-3 py-1 text-sm font-medium text-blue-800 bg-red-100 rounded-full dark:bg-blue-900 dark:text-blue-300">
            Fechado
        </span>
    @endif
    <form method="POST" action="#">
        @csrf
        <table class="min-w-full mb-6">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Documento</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Arquivo</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Ação</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Justificativa
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($documents as $document)
                    <tr class="bg-gray-50 dark:bg-gray-800 dark:border-gray-600 rounded-xl border-b">
                        <td class="px-4 py-2 font-semibold text-gray-800 dark:text-white">
                            {{ $document->document->title }}
                            {{ $document->document->name }}
                        </td>
                        <td class="px-4 py-2">
                            <a href="" target="_blank" class="text-blue-600 underline">Visualizar</a>
                        </td>
                        <td class="px-4 py-2">
                            <label class="inline-flex items-center mr-2">
                                <input type="radio" name="status[]" value="accepted" class="form-radio text-green-600"
                                    required>
                                <span class="ml-1 text-green-700">Aceitar</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="status[]" value="rejected" class="form-radio text-red-600">
                                <span class="ml-1 text-red-700">Recusar</span>
                            </label>
                        </td>
                        <td class="px-4 py-2">
                            <textarea name="justification[]" rows="1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Obrigatório se recusar..."></textarea>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar
            validação</button>
    </form>
</div>
