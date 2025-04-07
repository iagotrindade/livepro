<div>
    <div class="col-span-1 grid grid-cols-1 w-full rounded-lg gap-4">
        <div class="col-span-1 shadow-sm dark:border-gray-700 p-6 dark:bg-gray-800 rounded-lg">

            <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312" />
            </svg>


            <h3 class="text-xl font-bold dark:text-white">{{ $salesData['sales']->count() }} vendas</h3>

            <div class="flex items-center">
                <div
                    class="flex items-center mr-1 py-0.5 text-base font-semibold text-center 
                text-green-500 dark:text-green-500">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    {{ $salesData['percentageChange'] }}%
                </div>

                <p class="text-gray-500 dark:text-gray-400 font-medium">vs último mês</p>
            </div>
        </div>

        <x-widget>
            <x-slot:icon>
                <svg class='w-8 h-8 text-gray-800 dark:text-white' aria-hidden='true' xmlns='http://www.w3.org/2000/svg'
                    width='24' height='24' fill='none' viewBox='0 0 24 24'>
                    <path stroke='currentColor' stroke-linecap='round' stroke-linejoin='round' stroke-width='2'
                        d='M13.6 16.733c.234.269.548.456.895.534a1.4 1.4 0 0 0 1.75-.762c.172-.615-.446-1.287-1.242-1.481-.796-.194-1.41-.861-1.241-1.481a1.4 1.4 0 0 1 1.75-.762c.343.077.654.26.888.524m-1.358 4.017v.617m0-5.939v.725M4 15v4m3-6v6M6 8.5 10.5 5 14 7.5 18 4m0 0h-3.5M18 4v3m2 8a5 5 0 1 1-10 0 5 5 0 0 1 10 0Z' />
                </svg>
            </x-slot>

            <x-slot:title>
                R$ 15.000 movimentado
            </x-slot>

            <x-slot:info>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 19V5m0 14-4-4m4 4 4-4" />
                </svg>

                45%
            </x-slot>
        </x-widget>

        <div class="col-span-1 shadow-sm dark:border-gray-700 p-6 dark:bg-gray-800 rounded-lg">
            <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207" />
            </svg>


            <h3 class="text-xl font-bold dark:text-white">R$ 3.413 de lucro</h3>

            <div class="flex items-center">
                <div
                    class="flex items-center mr-1 py-0.5 text-base font-semibold text-center 
            text-red-500 dark:text-red-500">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19V5m0 14-4-4m4 4 4-4" />
                    </svg>

                    45%
                </div>

                <p class="text-gray-500 dark:text-gray-400 font-medium">vs último mês</p>
            </div>
        </div>

        <div class="col-span-1 shadow-sm dark:border-gray-700 p-6 dark:bg-gray-800 rounded-lg">

            <svg class="w-8 h-8 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.891 15.107 15.11 8.89m-5.183-.52h.01m3.089 7.254h.01M14.08 3.902a2.849 2.849 0 0 0 2.176.902 2.845 2.845 0 0 1 2.94 2.94 2.849 2.849 0 0 0 .901 2.176 2.847 2.847 0 0 1 0 4.16 2.848 2.848 0 0 0-.901 2.175 2.843 2.843 0 0 1-2.94 2.94 2.848 2.848 0 0 0-2.176.902 2.847 2.847 0 0 1-4.16 0 2.85 2.85 0 0 0-2.176-.902 2.845 2.845 0 0 1-2.94-2.94 2.848 2.848 0 0 0-.901-2.176 2.848 2.848 0 0 1 0-4.16 2.849 2.849 0 0 0 .901-2.176 2.845 2.845 0 0 1 2.941-2.94 2.849 2.849 0 0 0 2.176-.901 2.847 2.847 0 0 1 4.159 0Z" />
            </svg>

            <h3 class="text-xl font-bold dark:text-white">154 estornos</h3>

            <div class="flex items-center">
                <div
                    class="flex items-center mr-1 py-0.5 text-base font-semibold text-center 
                text-green-500 dark:text-green-500">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    45%
                </div>

                <p class="text-gray-500 dark:text-gray-400 font-medium">vs último mês</p>
            </div>
        </div>
    </div>
</div>
