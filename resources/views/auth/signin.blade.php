<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>LivePRO</title>
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        @vite('resources/css/app.css')
    </head>

    <body>
       
        <section class="h-screen flex flex-col justify-center items-center">
            <div class="w-full mx-auto xl:w-3/6 text-center bg-slate-50 border border-gray-200 rounded-lg shadow px-px-10 py-px-5 pb-5">
                <div class="w-full flex justify-between items-center px-10 pt-5 pb-5 border-b-1">
                    <p class="text-2xl text-black font-bold">LivePRO</p>
                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-blue-800">Seja PRO</button>
                </div>

                <hr class="h-px">

                <div class="flex flex-col justify-between items-start xl:flex-row xl:justify-center ">
                    <div class="px-10 flex-1 mt-16">
                        <h1 class="text-left text-2xl font-semibold mb-3">
                            Bem Vindo ao LivePRO
                        </h1>

                        <p class="text-left text-black text-lg">
                            Encontre o Profissional que você precisa sem sair do conforto da sua casa
                        </p>

                        <form class="flex flex-col" action="{{route('signin.action')}}" method="POST">
                            @csrf
                            <div class="flex flex-col justify-between items-center gap-0 xl:flex-row xl:gap-3">
                                <div class="w-full">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-start mt-5">Digite seu email</label>
                                    <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Ex: email@exemplo.com">
                                </div>

                                <div class="w-full">
                                    <label for="default-input" class="block mb-2 text-sm font-medium text-start mt-5">Digite sua senha</label>
                                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-black text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="********">
                                </div>
                            </div>

                            <div class="flex justify-between items-center mt-6 gap-3">
                                <div class="h-px w-full bg-red-700"></div>
                                    ou
                                <div class="h-px w-full bg-red-700"></div>
                            </div>

                            <div class="w-full bg-gray-200 p-2.5 mt-5 rounded-lg cursor-pointer flex justify-center hover:bg-gray-300 text-gray-500 hover:text-red-700">
                                <svg class="w-6 h-6 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12.037 21.998a10.313 10.313 0 0 1-7.168-3.049 9.888 9.888 0 0 1-2.868-7.118 9.947 9.947 0 0 1 3.064-6.949A10.37 10.37 0 0 1 12.212 2h.176a9.935 9.935 0 0 1 6.614 2.564L16.457 6.88a6.187 6.187 0 0 0-4.131-1.566 6.9 6.9 0 0 0-4.794 1.913 6.618 6.618 0 0 0-2.045 4.657 6.608 6.608 0 0 0 1.882 4.723 6.891 6.891 0 0 0 4.725 2.07h.143c1.41.072 2.8-.354 3.917-1.2a5.77 5.77 0 0 0 2.172-3.41l.043-.117H12.22v-3.41h9.678c.075.617.109 1.238.1 1.859-.099 5.741-4.017 9.6-9.746 9.6l-.215-.002Z" clip-rule="evenodd"/>
                                </svg>
                                  
                                <a href="{{ route('google.login') }}">Continue com o Google</a>
                            </div>

                            <div class="w-full flex justify-between mt-6">
                                <div class="flex justify-start items-center">
                                    <input type="checkbox" id="remember_token" name="remember_token" class="bg-gray-50 border border-gray-300 text-red-700 text-sm rounded-md focus:ring-red-500 focus:border-red-500  p-2.5 me-2">
                                    <label for="remember" class=" text-sm font-medium text-start">Lembrar de mim</label>
                                </div>
                                
                                <a class="text-red-700 font-semibold hover:underline" href="">Esqueceu sua senha?</a>
                            </div>

                            <button type="submit" class="w-full bg-red-700 text-white p-2.5 mt-5 rounded-lg hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium">Login</button>
                        </form>
                    </div>
                       
                    <div class="flex-1 mt-5">
                        <div class="relative mx-auto border-black  bg-black border-[14px] rounded-[2.5rem] h-[600px] w-[300px]">
                            <div class="h-[32px] w-[3px] bg-black absolute -start-[17px] top-[72px] rounded-s-lg"></div>
                            <div class="h-[46px] w-[3px] bg-black absolute -start-[17px] top-[124px] rounded-s-lg"></div>
                            <div class="h-[46px] w-[3px] bg-black absolute -start-[17px] top-[178px] rounded-s-lg"></div>
                            <div class="h-[64px] w-[3px] bg-black absolute -end-[17px] top-[142px] rounded-e-lg"></div>
                            <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-red-700">
                                <img src="{{url('storage/assets/images/login_image.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    </body>
</html>
