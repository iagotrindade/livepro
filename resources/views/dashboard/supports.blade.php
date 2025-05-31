<!-- filepath: c:\laragon\www\livepro\resources\views\dashboard\supports.blade.php -->
<x-layouts.dashboard-layout page="support">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewSupport')
            <x-dashboard.navigation-info title="Tickets de Suporte" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>

            <!-- Boxes Section -->
            <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-4 gap-4 mb-6">
                <!-- Total Tickets -->
                <div class="dark:border-gray-700 dark:bg-gray-800 flex items-center p-4 rounded-lg shadow-md">
                    <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-lg dark:bg-blue-900 dark:text-blue-300">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M4 5a2 2 0 0 0-2 2v2.5a1 1 0 0 0 1 1 1.5 1.5 0 1 1 0 3 1 1 0 0 0-1 1V17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2.5a1 1 0 0 0-1-1 1.5 1.5 0 1 1 0-3 1 1 0 0 0 1-1V7a2 2 0 0 0-2-2H4Z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-black dark:text-gray-200">
                            {{App\Models\Support::count()}}
                        </p>
                        <p class="text-lm font-medium text-gray-400">Tickets</p>
                    </div>
                </div>

                <!-- Pending Tickets -->
                <div class="dark:border-gray-700 dark:bg-gray-800 flex items-center p-4 rounded-lg shadow-md">
                    <div
                        class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-lg dark:bg-yellow-400 dark:text-yellow-400">
                        <svg class="w-6 h-6 text-yellow-400 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M5.5 3a1 1 0 0 0 0 2H7v2.333a3 3 0 0 0 .556 1.74l1.57 2.814A1.1 1.1 0 0 0 9.2 12a.998.998 0 0 0-.073.113l-1.57 2.814A3 3 0 0 0 7 16.667V19H5.5a1 1 0 1 0 0 2h13a1 1 0 1 0 0-2H17v-2.333a3 3 0 0 0-.56-1.745l-1.616-2.82a1 1 0 0 0-.067-.102 1 1 0 0 0 .067-.103l1.616-2.819A3 3 0 0 0 17 7.333V5h1.5a1 1 0 1 0 0-2h-13Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-lg font-semibold text-black dark:text-gray-200">
                            {{App\Models\Support::where('status', 'open')->count()}}
                        </p>
                        <p class="text-lm font-medium text-gray-400">Abertos</p>
                    </div>
                </div>

                <!-- In Progress Tickets -->
                <div class="dark:border-gray-700 dark:bg-gray-800 flex items-center p-4 rounded-lg shadow-md">
                    <div
                        class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-900 dark:text-orange-300">
                        <svg class="w-6 h-6 text-orange-400 dark:text-orange-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <div>
                        <p class="text-lg font-semibold text-black dark:text-gray-200">
                            {{App\Models\Support::where('status', 'in_progress')->count()}}
                        </p>
                        <p class="text-lm font-medium text-gray-400">Em andamento</p>
                    </div>
                </div>

                <!-- Solved Tickets -->
                <div class="dark:border-gray-700 dark:bg-gray-800 flex items-center p-4 rounded-lg shadow-md">
                    <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-lg dark:bg-green-900 dark:text-green-300">
                        <svg class="w-6 h-6 text-green-400 dark:text-green-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                clip-rule="evenodd" />
                        </svg>

                    </div>
                    <div>
                        <p class="text-lg font-semibold text-black dark:text-gray-200">
                            {{App\Models\Support::where('status', 'resolved')->count()}}
                        </p>
                        <p class="text-lm font-medium text-gray-400">Resolvidos</p>
                    </div>
                </div>
            </div>

            <!-- Tickets Table -->
            <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full mb-4">
                @livewire('dashboard.tables.supports-table')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
