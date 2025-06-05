<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LivePRO - Cadastrar-se</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="flex max-w-6xl bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Left: Login form -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <h2 class="text-2xl font-bold mb-2">Bem vindo (a) ao LivePRO</h2>
            <p class="text-sm mb-6">Descubra centenas de profissionais a um clique de distância. Já possui uma conta?
                <a href="{{ route('login') }}" class="cursor-pointer text-blue-400 hover:underline">Faça login.</a>
            </p>

            <form action="{{ route('signup.action') }}" method="POST" class="space-y-4">
                @csrf

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block mb-1 text-sm">Nome Completo</label>
                        <input type="name" id="name" name="name"
                            class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                            placeholder="Nome Completo" required>
                    </div>

                    <div>
                        <label for="email" class="block mb-1 text-sm">Email</label>
                        <input type="email" id="email" name="email"
                            class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                            placeholder="nome@email.com" required>
                    </div>
                </div>

                <div>
                    <label for="phone" class="block mb-1 text-sm">Telefone</label>
                    <input type="phone" id="phone" name="phone"
                        class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                        placeholder="(51) 9 9999 9999" required>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block mb-1 text-sm">Senha</label>
                        <input type="password" id="password" name="password" placeholder="********"
                            class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                            required>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block mb-1 text-sm">Confirme a Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="********"
                            class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                            required>
                    </div>

                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition duration-200">
                    Criar sua conta
                </button>
            </form>

            <div class="my-6 flex items-center justify-center">
                <span class="w-full border-t border-gray-600"></span>
                <span class="px-2 text-sm text-gray-400">ou</span>
                <span class="w-full border-t border-gray-600"></span>
            </div>

            <div class="space-y-3">
                <a href="{{ route('google.login') }}"
                    class="w-full flex items-center justify-center border border-gray-600 rounded-md px-4 py-2 hover:bg-gray-700">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5 mr-2">
                    Cadastrar-se com o Google
                </a>
                <button
                    class="w-full flex items-center justify-center border border-gray-600 rounded-md px-4 py-2 hover:bg-gray-700">
                    <img src="{{ url('storage/assets/images/apple_icon.png') }}" alt="Google" class="w-5 h-5 mr-2">
                    Cadastrar-se com a Apple
                </button>
            </div>
        </div>

        <!-- Right: Illustration -->
        <div class="md:flex md:w-1/2 items-center justify-center bg-gray-900 p-4">
            <img src="{{ url('storage/assets/images/login_image.svg') }}" alt="Illustration" class="w-3/4 h-auto">
        </div>
    </div>
</body>

</html>
