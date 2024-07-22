@extends('layout.app')
@section('content')
    @include('components.navbar')
    <div>
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto mt-20 lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-gray">
                Accedi al tuo account
            </a>
            <div
                class="w-full bg-white rounded-lg shadow border md:mt-0 sm:max-w-md xl:p-0 border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray md:text-2xl">
                        Inserisci i tuoi dati
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="{{ route('login') }}" method="post">
                        @csrf
                        <div>
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-100 border border-gray-600 text-black sm:text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 placeholder-gray-400 "
                                placeholder="email@email.com" required="">
                        </div>
                        @error('email')
                            <div class="text-gray-900">{{ $message }}</div>
                        @enderror
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray">
                                Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-100 border border-gray-600 text-black sm:text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 placeholder-gray-400 "
                                required="">
                        </div>
                        @error('password')
                            <div class="text-gray-900">{{ $message }}</div>
                        @enderror


                        <button type="submit"
                            class="w-full text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-primary-800">
                            Accedi
                        </button>
                        <p class="text-sm font-light text-gray-500">
                            Non hai un account? <a href="{{ route('register') }}"
                                class="font-medium text-gray-400 hover:underline">Registrati</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
