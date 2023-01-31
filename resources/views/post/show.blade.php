@extends('layout')

@section('content')
<div class="container mx-auto bg-gray-50">
    <div class="pl-16 pt-10">
        <h2 class="text-4xl">{{ $post->title }}</h2>
        @if ($post->photo)
        <div class="mt-4">
            <img src="{{ asset($post->photo) }}" alt="cover photo">
        </div>
        @endif
        <div class="mt-8">
            {{ $post->content }}
            <div class="h-52"></div>
        </div>

        <hr>

        <livewire:comments-section :post="$post"/>
    </div>

</div>
@endsection