@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <div>
                <img class="mx-auto h-12 w-auto" src="/img/logos/basketball.svg" alt="Workflow"/>
                <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
                    Start your free account
                </h2>
                <p class="mt-2 text-center text-sm leading-5 text-gray-600 max-w">
                    Or
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500
                       focus:outline-none focus:underline transition ease-in-out duration-150">
                    sign-in to an existing account
                    </a>
                </p>
            </div>
            <form class="mt-8" action="{{ route('register') }}" method="POST">
                @csrf

                <div>
                    <label for="name" class="block text-sm leading-5 font-medium text-gray-700">Name</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            autocomplete="name"
                            required
                            autofocus
                            class="form-input block w-full sm:text-sm sm:leading-5 @error('name')  border-red-500 @enderror"
                            placeholder=""/>
                    </div>
                    @error('name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="email" class="block text-sm leading-5 font-medium text-gray-700">Email Address</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            required
                            value="{{ old('email') }}"
                            autocomplete="email"
                            class="form-input block w-full sm:text-sm sm:leading-5 @error('email')  border-red-500 @enderror"
                            placeholder=""/>
                    </div>
                    @error('email')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="password" class="block text-sm leading-5 font-medium text-gray-700">Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="form-input block w-full sm:text-sm sm:leading-5 @error('password')  border-red-500 @enderror"
                            placeholder=""/>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mt-6">
                    <label for="password-confirm" class="block text-sm leading-5 font-medium text-gray-700">Confirm
                        Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input
                            id="password-confirm"
                            name="password_confirmation"
                            type="password"
                            required
                            autocomplete="new-password"
                            class="form-input block w-full sm:text-sm sm:leading-5 @error('password')  border-red-500 @enderror"
                            placeholder=""/>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                        <span class="absolute left-0 inset-y pl-3">
                            <svg
                                class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition ease-in-out duration-150"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </span>
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
