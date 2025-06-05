<x-layouts.dashboard-layout page="docs">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewDocs')
            <x-dashboard.navigation-info title="Validação de Documentos"
                :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="border-gray-300 rounded-lg dark:border-gray-600 grid grid-cols-2 gap-4">
                @if($user->hasRole(['super-admin', 'Gerente']))
                    <div class="col-span-full xl:col-auto grid gap-4">
                        @livewire('dashboard.charts.documents-chart')

                        @livewire('dashboard.charts.documents-quantity-chart')
                    </div>

                    <div class="grid gap-4 col-span-2 xl:col-auto">
                        @livewire('dashboard.components.documents-details')

                        @livewire('dashboard.charts.document-by-category-chart')
                    </div>
                @endif

                <div class="grid gap-4 col-span-full">
                    @livewire('dashboard.tables.documents-table')
                </div>
                
                <div class="grid gap-4 col-span-full">
                    @livewire('dashboard.tables.documents-validation-table')
                </div>
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
