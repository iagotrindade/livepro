<x-layouts.dashboard-layout page="users">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewUsers')
            <x-dashboard.navigation-info title="Todos usuários" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="border-gray-300 rounded-lg dark:border-gray-600">
                @livewire('dashboard.tables.users-table')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
