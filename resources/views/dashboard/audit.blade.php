<x-layouts.dashboard-layout page="audit">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewAudit')
            <x-dashboard.navigation-info title="Logs de auditoria" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
       
            @livewire('dashboard.tables.audit-table')
        @endcan
    </div>
</x-layouts.dashboard-layout>