<x-layouts.dashboard-layout page="support">
    <div class="p-4 md:ml-64 h-auto pt-20">
        @can('viewSupport')
            <x-dashboard.navigation-info title="Suporte ao Usúario" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>
            <div class="border-gray-300 rounded-lg dark:border-gray-600">
                @livewire('dashboard.components.support-area')
            </div>
        @endcan
    </div>
</x-layouts.dashboard-layout>
