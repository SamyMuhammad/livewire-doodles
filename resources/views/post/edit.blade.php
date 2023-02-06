@extends('layout')

@section('content')
<div>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
            <div class="mb-4">
                <h1 class="font-serif text-3xl font-bold underline decoration-gray-400">
                    Edit Post
                </h1>
            </div>

            <div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
                <form method="POST" action="{{ route('post.update', $post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <!-- Title -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700" for="title">
                            Title
                        </label>

                        <input
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus-visible:outline-none"
                            type="text" name="title" placeholder="180" value="{{ $post->title }}" />
                        @error('title')
                        <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mt-4">
                        <label class="block text-sm font-bold text-gray-700" for="content">
                            Description
                        </label>
                        <textarea name="content"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus-visible:outline-none"
                            rows="4" placeholder="400">{{ $post->content }}</textarea>
                        @error('content')
                        <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div class="mt-4">
                        <label class="block text-sm font-bold text-gray-700" for="photo">
                            Photo
                        </label>
                        <div class="block w-full mt-1">
                            <input
                                class="border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus-visible:outline-none"
                                type="file" name="photo" />
                            @error('photo')
                                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                            @enderror
                            <img class="w-40 inline-block ml-5 rounded-md float-right" src="{{ asset($post->photo) }}" alt="photo">
                            <div class="clear-right"></div>
                        </div>
                    </div>

                    <div class="flex items-center justify-start mt-4 gap-x-2">
                        <button type="submit"
                            class="px-6 py-2 text-sm font-semibold rounded-md shadow-md text-sky-100 bg-sky-500 hover:bg-sky-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection