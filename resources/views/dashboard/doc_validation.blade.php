<x-layouts.dashboard-layout page="docs">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewDocs')
            <x-dashboard.navigation-info title="Validação de Documentos" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>

            @livewire('dashboard.components.document-validation-area')
        @endcan
    </div>
</x-layouts.dashboard-layout>
