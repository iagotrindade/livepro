<div wire:poll.15s='pollNotifications'>
    <button wire:click="readAllNotifications" type="button" data-dropdown-toggle="notification-dropdown"
        class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
        <span class="sr-only">Ver notificações</span>
        <!-- Bell icon -->
        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
                d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z">
            </path>
        </svg>
        @if($user->unreadNotifications->isNotEmpty())
            <span class="top-3.5 left-15 absolute  w-3.5 h-3.5 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></span>
        @endif
    </button>
    <!-- Dropdown menu -->
    <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700 rounded-xl"
        id="notification-dropdown">
        <div
            class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
            Notificações
        </div>

        @if (($notifications->isNotEmpty()))
            <div>
                @foreach ($notifications as $notification)
                    <div
                        class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="flex-shrink-0">
                            <div class="w-11 h-11 rounded-full">
                                {!! $notification->data['image'] !!}
                            </div>
                        </div>
                        <div class="pl-3 w-full">
                            <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                                {!! Str::of($notification->data['body'])->limit(120, '...') !!}
                            </div>
                            <div class="text-xs font-medium text-blue-600 dark:text-primary-500">
                                <p>{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else 
            <div class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600 text-center text-gray-500 dark:text-gray-400">
                Você ainda não tem nenhuma notificação
            </div>
        @endif


        <a href="{{ route('notifications') }}"
            class="block py-2 text-md font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-600 dark:text-white dark:hover:underline">
            <div class="inline-flex items-center">
                <svg aria-hidden="true" class="mr-2 w-4 h-4 text-gray-500 dark:text-gray-400" fill="currentColor"
                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    <path fill-rule="evenodd"
                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                        clip-rule="evenodd"></path>
                </svg>
                Ver todas
            </div>
        </a>
    </div>
</div>
