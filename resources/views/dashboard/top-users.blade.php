<x-layouts.dashboard-layout page="marketing">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewMarketing')
            <x-dashboard.navigation-info title="TOP Usuários" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="grid gap-4">
                @livewire('dashboard.components.top-users-area')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
