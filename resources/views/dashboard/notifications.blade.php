<x-layouts.dashboard-layout page="dashboard">
    <div class="p-4 md:ml-64 h-auto pt-20">
        <x-dashboard.navigation-info title="Suas notificações" :breadcrumbs="$breadcrumbs"></x-dashboard.navigation-info>

        <div class="w-full rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
            @if ($user->notifications->isNotEmpty())
                <ol class="relative border-s border-gray-200 dark:border-gray-700">

                    @foreach ($user->notifications as $notification)
                        <li class="mb-10 ms-6">
                            <span
                                class="absolute flex items-center justify-center w-7 h-7 bg-blue-100 rounded-full -start-3.5 ring-white dark:ring-gray-900 dark:bg-blue-900">
                                {!! $notification->data['image'] !!}
                            </span>
                            <h3 class="flex items-center mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                                {{ $notification->data['title'] }}
                                @if ($notification->created_at->isToday())
                                    <span
                                        class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 ms-3">
                                        Recente
                                    </span>
                                @endif
                            </h3>
                            <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                <p>{{ $notification->created_at->diffForHumans() }}</p>
                            </time>
                            <p class="mb-4 text-base font-normal text-gray-500 dark:text-gray-400">
                                {{ $notification->data['body'] }}
                            </p>
                            @if (!empty($notification->data['download']))
                                <a href="{{ $notification->data['url'] }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 dark:focus:ring-gray-700"><svg
                                        class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z" />
                                        <path
                                            d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z" />
                                    </svg>
                                    Download
                                </a>
                            @endif

                        </li>
                    @endforeach

                </ol>
            @else
                <p class="text-white">Você ainda não possuí nenhuma notificação.</p>
            @endif
        </div>
    </div>
</x-layouts.dashboard-layout>
