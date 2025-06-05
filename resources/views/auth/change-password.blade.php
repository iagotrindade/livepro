<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LivePRO - Criar Nova Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="flex max-w-6xl bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Left: Login form -->
        <div class="w-full md:w-1/2 p-8 md:p-12">
            <h2 class="text-2xl font-bold mb-2">
                Recuperação da conta LivePRO
            </h2>
            
            <p class="text-sm mb-6">Por favor, crie uma senha para acessar sua conta. Não possui uma conta?
                <a href="" class="cursor-pointer text-blue-400 hover:underline">Cadastre-se.</a>
            </p>

            <form action="{{ route('password.reset.action') }}" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="token" id="" value="{{ $token }}">

                <div>
                    <label for="email" class="block mb-1 text-sm">Email</label>
                    <input id="disabled-input" aria-label="disabled input" type="email" name="email" value="{{ $email }}" disabled
                        class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-gray-400 focus:ring-transparent focus:outline-none"
                        required>
                </div>

                <div>
                    <label for="password" class="block mb-1 text-sm">Nova Senha</label>
                    <input type="password" id="password" name="password" placeholder="********"
                        class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                        required>
                </div>

                <div>
                    <label for="password_confirmation" class="block mb-1 text-sm">Confirmar Senha</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="********"
                        class="border rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 bg-gray-700 border-gray-600 placeholder-gray-400 text-white focus:ring-transparent focus:outline-none"
                        required>
                </div>

                <div class="flex items-center justify-between text-sm">
                    <a href="{{ route('login') }}" class="text-blue-400 hover:underline">
                       Lembrou sua senha?
                    </a>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition duration-200">
                    Entrar na sua conta
                </button>
            </form>
        </div>

        <!-- Right: Illustration -->
        <div class="md:flex md:w-1/2 items-center justify-center bg-gray-900 p-4">
            <img src="{{ url('storage/assets/images/2fa_image.svg') }}" alt="Illustration" class="w-3/4 h-auto">
        </div>
    </div>
</body>

</html>
