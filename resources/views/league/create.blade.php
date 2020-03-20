@extends('layouts.app')

@section('content')
    <form action="{{ route('league.store') }}" method="post">
        @csrf
        <label for="name" class="block text-sm leading-5 font-medium text-gray-700">League Name</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                class="form-input block w-full sm:text-sm sm:leading-5 @error('name')  border-red-500 @enderror"
            >
        </div>
        @error('name')
        <p id="errorName" class="text-red-500 text-xs italic mt-4">
            {{ $message }}
        </p>
        @enderror
        <div class="mt-6">
            <button
                id="submit"
                type="submit"
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out"
            >
                <span class="absolute left-0 inset-y pl-3">
                    <svg
                        class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400 transition ease-in-out duration-150"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V8z" clip-rule="evenodd"></path>
                    </svg>
                </span>
                Create League
            </button>
        </div>
    </form>
@endsection
