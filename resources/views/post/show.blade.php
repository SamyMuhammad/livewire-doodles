@extends('layout')

@section('content')
<div class="container mx-auto bg-gray-50">
    @if (session()->has('post_updated'))
        <div class="rounded-md bg-green-50 p-4 my-8">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium text-green-800">
                        {{ session('post_updated') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
    <div class="pl-16 pt-10">
        <div class="grid grid-cols-3 gap-4">
            <h2 class="text-4xl col-span-2">{{ $post->title }}</h2>
            <div>
                <a class="inline-block w-7" href="{{ route('post.edit', $post) }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path class="text-green-700" stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>
            </div>
        </div>
        @if ($post->photo)
        <div class="mt-4 w-4/5">
            <img src="{{ asset($post->photo) }}" alt="cover photo">
        </div>
        @endif
        <div class="mt-8">
            {{ $post->content }}
            <div class="h-52"></div>
        </div>

        <hr>

        <livewire:comments-section :post="$post" />
    </div>

</div>
@endsection