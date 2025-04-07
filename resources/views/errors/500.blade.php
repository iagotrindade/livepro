<x-layouts.empty-layout>
    <main class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col justify-center items-center px-6 mx-auto h-screen xl:px-0 dark:bg-gray-900">
            <div class="block max-w-lg">
                <img src="https://flowbite-admin-dashboard.vercel.app/images/illustrations/500.svg" alt="astronaut image">
            </div>
            <div class="text-center xl:max-w-4xl">
                <h1 class="mb-3 text-2xl font-bold leading-tight text-gray-900 sm:text-4xl lg:text-5xl dark:text-white">
                    Algo deu muito errado</h1>
                <p class="mb-5 text-base font-normal text-gray-500 md:text-lg dark:text-gray-400">
                    Sempre é hora de um pausa para o café. Devemos estar de volta quando você terminar seu café.
                </p>
                <a href="{{ route('home') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-3 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="mr-2 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Voltar ao início
                </a>
            </div>
        </div>
    </main>
</x-layouts.empty-layout>
