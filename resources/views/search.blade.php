@extends('layout')
@section('title', 'Search')
@section('content')
<div class="min-h-screen bg-indigo-50">
    <header class="bg-white shadow">
        <!-- example of centering row items in header -->
        <div class="flex items-center justify-between h-16 px-4">
            <!-- search box -->
            <div class="w-80 my-10 mx-auto">
                <!-- search example -->
                <livewire:search-dropdown />
                <!-- end search example -->
            </div>
            <!-- end search box -->
        </div>
        <!-- end example of centering row items in header  -->
    </header>
</div>
@endsection