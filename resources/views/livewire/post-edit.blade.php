<div class="w-full px-6 py-4 bg-white rounded shadow-md ring-1 ring-gray-900/10">
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
    <form wire:submit.prevent='submitForm' method="POST" action="#" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <!-- Title -->
        <div>
            <label class="block text-sm font-bold text-gray-700" for="title">
                Title
            </label>

            <input wire:model='title'
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
            <textarea wire:model='content' name="content"
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
                <div class="grid grid-cols-10 gap-2">
                    <input wire:model='photo'
                        class="col-span-4 border-gray-300 rounded-md shadow-sm placeholder:text-gray-400 placeholder:text-right focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 focus-visible:outline-none"
                        type="file" name="photo" />
                    <span wire:loading wire:target='photo'>
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-grey-700 float-right" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </div>
                @error('photo')
                <p class="text-red-500 mt-1 text-sm">{{ $message }}</p>
                @enderror
                @if ($photo)
                    <img class="w-40 inline-block ml-5 rounded-md float-right" src="{{ $tempUrl }}" alt="temp">
                @else
                    <img class="w-40 inline-block ml-5 rounded-md float-right" src="{{ asset($post->photo) }}" alt="photo">
                @endif
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