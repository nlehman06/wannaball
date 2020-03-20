@extends('layouts.app')

@section('content')

    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
        Dashboard
    </h2>


    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">
                Your Top Leagues
            </h3>
        </div>
        <div>
            @forelse($topLeagues as $league)
                <div
                    class="px-4 py-5 sm:px-6 flex items-center justify-between @if(!$loop->last) border-b border-gray-200 @endif">
                    <a href="{{ route('league.show', $league) }}" class="leading-5 font-medium text-gray-900">
                        {{ $league->name }}
                    </a>
                    <a href="{{ route('league.show', $league) }}">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-8 h-8 text-gray-600">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            @empty
                <p class="text-lg px-4 py-7">You aren't apart of any leagues yet. Would you like to
                    <span class="bg-gray-800 rounded px-3 py-2">
                        <a href="{{ route("league.create") }}" class="text-white">create one</a>
                    </span>?
                </p>
            @endforelse
        </div>
    </div>

@endsection
