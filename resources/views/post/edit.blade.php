@extends('layout')

@section('title', 'Edit Post')
@section('content')
<div>
    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div class="w-full px-16 py-20 mt-6 overflow-hidden bg-white rounded-lg lg:max-w-4xl">
            <div class="mb-4">
                <h1 class="font-serif text-3xl font-bold underline decoration-gray-400">
                    Edit Post
                </h1>
            </div>

            <livewire:post-edit :post="$post" />
        </div>
    </div>
</div>
@endsection