<!DOCTYPE html>
<html lang="pt-BR" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @livewireStyles
    <title>LivePRO</title>

    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireScripts
</head>

<body>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        <!-- Header -->
        <x-dashboard.header></x-dashboard.header>

        <!-- Sidebar -->
        <x-dashboard.sidebar page={{$page}}></x-dashboard.sidebar>

         <!-- Main content -->
        <main>
            {{$slot}}
        </main>
    </div>
    
</body>

</html>
