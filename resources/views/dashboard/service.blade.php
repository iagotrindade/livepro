<x-layouts.dashboard-layout page="dashboard">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewFinancial')
            <x-dashboard.navigation-info title="Detalhes do serviço" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="border-gray-300 rounded-lg dark:border-gray-600">
                @livewire('dashboard.components.service-area')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
