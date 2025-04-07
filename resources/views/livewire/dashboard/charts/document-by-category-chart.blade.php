<div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
    <div class="w-full">
        <h5 class="mb-2 text-xl font-bold leading-none text-gray-900 dark:text-white">Categorias x Documentações
        </h5>
        @foreach ($occupationArray as $item)
            <div class="flex flex-col items-start mb-2">
                <div class="w-full text-sm font-medium dark:text-white">{{ $item->occupation }} ( {{ $item->count }} )</div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $item->percentage }}%"></div>
                </div>
            </div>
        @endforeach

    </div>
    <div id="traffic-channels-chart" class="w-full"></div>
</div>
