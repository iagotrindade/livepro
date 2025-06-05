<x-layouts.dashboard-layout page="dashboard">
    
    <div class="p-4 md:ml-64 h-auto pt-20">
        <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4 mb-4">
            @can('viewFinancial')
                <div class="border-gray-300 rounded-lg dark:border-gray-600 col-span-2">
                    @livewire('dashboard.charts.sales-chart')
                </div>
            @endcan

            @can('viewMarketing')
                <div class="rounded-lg border-gray-300 dark:border-gray-600 h-full">
                    @livewire('dashboard.tables.top-users-table')
                </div>
            @endcan
        </div>

        @can('viewServices')
            <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full mb-4">
                @livewire('dashboard.tables.services-table')
            </div>
        @endcan

        <div class="grid grid-cols-2 gap-4 mb-4">
            @can('viewMarketing')
                <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full">
                    @livewire('dashboard.charts.visitors-chart')
                </div>
            @endcan

            @if (auth()->user()->can('viewMarketing') || auth()->user()->can('viewFinancial'))
                <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full">
                    @livewire('dashboard.charts.pro-users-chart')
                </div>
            @endif
        </div>

        @can('viewSupport')
            <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full mb-4">
                @livewire('dashboard.tables.supports-table')
            </div>
        @endcan

        @can('viewDocs')
            <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-2 gap-4 mb-4">
                <div class="border-gray-300 rounded-lg dark:border-gray-600">
                    @livewire('dashboard.charts.documents-chart')
                </div>
                <div class="rounded-lg border-gray-300 dark:border-gray-600 h-full grid grid-cols-1 gap-4">
                    @livewire('dashboard.charts.document-by-category-chart')

                    @livewire('dashboard.charts.documents-quantity-chart')
                </div>
            </div>

            <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full mb-4">
                @livewire('dashboard.tables.documents-table')
            </div>

            <div class="rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-full mb-4">
                @livewire('dashboard.tables.documents-validation-table')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
