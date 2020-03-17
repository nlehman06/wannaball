@extends('layouts.app')

@section('content')

    @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4"
             role="alert">
            {{ session('status') }}
        </div>
    @endif

    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:leading-9 sm:truncate">
        Dashboard
    </h2>

    <ul>
        @forelse($topLeagues as $league)
            <li>{{ $league->name }}</li>
            @empty
            <p>You aren't apart of any leagues yet.  Would you like to <a href="{{ route("league.create") }}">create one</a>?</p>
        @endforelse
    </ul>

@endsection
