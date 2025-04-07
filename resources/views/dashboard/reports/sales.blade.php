<x-layouts.dashboard-layout page="report">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewFinancial')
            <x-dashboard.navigation-info title="Relatório de vendas" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="border-gray-300 rounded-lg dark:border-gray-600 grid gap-4">
                <div class="grid grid-cols-3 gap-4">
                    <div class="col-span-2">
                        @livewire('dashboard.charts.sales-chart')
                    </div>
                    @livewire('dashboard.components.sales-details')
                </div>
                @livewire('dashboard.tables.services-table')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
