<x-layouts.dashboard-layout page="permissions">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewPermissions')
            <x-dashboard.navigation-info title="Grupos de permissão" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 mb-4">
                <div class="border-gray-300 rounded-lg dark:border-gray-600 col-span-1 2xl:col-span-2">
                    @livewire('dashboard.tables.permissions-table')
                </div>
                <div class="rounded-lg border-gray-300 dark:border-gray-600">
                    @livewire('dashboard.tables.user-permissions')
                </div>
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
