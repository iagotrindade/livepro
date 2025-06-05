<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LivePRO - 2FA</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">
    <div class="flex items-center justify-center w-full max-w-6xl px-4 py-12">
        <!-- Form -->
        <div class="bg-gray-800 text-white p-8 rounded-lg shadow-md md:w-1/2 w-full">
            <div class="mb-4">
                <div class="flex items-center space-x-2 mb-2">
                    <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0zM9 15l-5-5 1.4-1.4L9 12.2l5.6-5.6L16 8l-7 7z" />
                    </svg>
                    <span class="font-semibold text-lg">LivePRO</span>
                </div>
                <h2 class="text-xl font-bold">Autenticação de dois fatores (2FA)</h2>
                <p class="text-sm text-gray-400">Enviamos um email com um código de confirmação para acessar sua conta,
                    digite-o abaixo.
                </p>
            </div>

            @error('code')
                <p class="text-red-500 text-sm text-left mb-4">{{ $message }}</p>
            @enderror
            <form action="{{ route('confirm.signin.action') }}" method="POST">
                @csrf

                <div class="grid grid-cols-6 gap-4 mb-6">
                    @for ($i = 0; $i < 6; $i++)
                        <input type="text" name="numbers[]" maxlength="1"
                            class="text-4xl text-center rounded bg-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            inputmode="numeric" pattern="[0-9]*" required />
                    @endfor
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded">
                    Verificar
                </button>

                <p class="text-sm text-gray-400 text-center mt-4">
                    Não tem acesso ao seu email?
                    <a href="{{ route('password.reset.form') }}" class="text-blue-400 hover:underline">Recuperar minha conta.</a>
                </p>
            </form>
        </div>

        <!-- Image -->
        <div class="hidden md:block md:w-1/2">
            <img src="{{ url('storage/assets/images/2fa_image.svg') }}" alt="Illustration" class="w-full h-auto" />
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const inputs = document.querySelectorAll('input[type="text"]');

            inputs.forEach((input, index) => {
                input.addEventListener('input', (e) => {
                    const value = e.target.value;
                    if (value.length > 1) {
                        e.target.value = value.charAt(0);
                    }
                    if (value && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && !input.value && index > 0) {
                        inputs[index - 1].focus();
                    }
                });

                input.addEventListener('paste', (e) => {
                    e.preventDefault();
                    const paste = e.clipboardData.getData('text').replace(/\D/g, '');
                    if (paste.length === inputs.length) {
                        inputs.forEach((input, i) => {
                            input.value = paste[i];
                        });
                        inputs[inputs.length - 1].focus();
                    }
                });
            });

            // Foco no primeiro input ao carregar a página
            inputs[0].focus();
        });
    </script>
</body>

</html>
