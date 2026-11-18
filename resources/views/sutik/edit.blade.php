@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto py-8">
        <h1 class="text-3xl font-bold text-white mb-6">
            Sütemény szerkesztése
        </h1>

        <form action="{{ route('sutik.update', $suti) }}"
              method="POST"
              class="bg-gray-800 p-6 rounded-lg">
            @include('sutik.urlap')
        </form>
    </div>
@endsection