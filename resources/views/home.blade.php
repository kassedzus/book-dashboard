@extends('layouts.app')

@section('content')
    <main class="grid min-h-full place-items-center bg-white px-6 py-24 sm:py-32 lg:px-8">
        <div class="text-center">

            @livewire('book-list')

        </div>
    </main>
@endsection
