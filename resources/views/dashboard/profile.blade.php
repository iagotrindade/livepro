<x-layouts.dashboard-layout page="permissions">
    <div class="p-4 md:ml-64 h-auto pt-20">
        <x-dashboard.navigation-info title="Seu perfil" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>

        <div class="border-gray-300 rounded-lg dark:border-gray-600 col-span-1 2xl:col-span-2">
            <main>
                @livewire('dashboard.components.profile-area')
            </main>
        </div>
    </div>
</x-layouts.dashboard-layout>
