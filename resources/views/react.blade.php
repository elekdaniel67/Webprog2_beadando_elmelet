@extends('layouts.app')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-6">
            Klubok kezelése
        </h1>

        <div id="klubok-app"></div>
    </div>

    @viteReactRefresh
    @vite('resources/js/klubok.jsx')
@endsection