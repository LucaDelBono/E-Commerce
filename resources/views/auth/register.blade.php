@extends('layout.app')
@section('content')
@include('component.navbar')
<div>
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto mt-20 lg:py-0">
        <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
            Crea un nuovo account    
        </div>
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray md:text-2xl">
                    Inserisci i tuoi dati
                </h1>
                <form class="space-y-4 md:space-y-1" action="{{route('register')}}" method="post">
                    @csrf
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray">Nome</label>
                        <input type="text" name="name" id="name" class="mb-2 bg-gray-100 border border-gray-600 text-black sm:text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 placeholder-gray-400 " placeholder="nome">
                    </div>
                    @error('name')
                        <div class="text-gray-900">{{$message}}</div>
                    @enderror                  
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Email</label>
                        <input type="email" name="email" id="email" class="mb-2 bg-gray-100 border border-gray-600 text-black sm:text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 placeholder-gray-400" placeholder="email@email.com">
                    </div>
                    @error('email')
                    <div class="text-gray-900">{{$message}}</div>
                    @enderror
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="mb-2 bg-gray-100 border border-gray-600 text-black sm:text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 placeholder-gray-400">
                    </div>
                    @error('password')
                    <div class="text-gray-900">{{$message}}</div>
                    @enderror
                    <div>
                        <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900">Conferma password</label>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••" class="bg-gray-100 border border-gray-600 text-black sm:text-sm rounded-lg focus:ring-gray-300 focus:border-gray-300 block w-full p-2.5 placeholder-gray-400" >
                    </div>
                    @error('password_confirmation')
                    <div class="text-gray-900">{{$message}}</div>
                    @enderror
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                          <input id="terms" aria-describedby="terms" type="checkbox" class="mt-4 w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-primary-300 focus:ring-primary-600 ring-offset-gray-800" required>
                        </div>
                        <div class="ml-3 text-sm mt-2 mb-3">
                          <label for="terms" class="font-light text-gray-600">Accetto i <a class="font-medium text-primary-500 hover:underline" href="#"> Termini e le Condizioni</a></label>
                        </div>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-primary-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center hover:bg-primary-800">
                        Crea account
                    </button>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-600">
                        Hai già un account? <a href="{{route('login')}}" class="font-medium text-gray-500 hover:underline">Accedi</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
