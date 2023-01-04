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
                <div class="relative">
                    <input type="search" value="Framework" class="w-full rounded-lg border border-gray-200 h-10 p-5 focus-visible:border-gray-200"
                        autocomplete="off" placeholder="Search" />
                    <!-- search result -->
                    <div
                        class="absolute z-10 w-full border rounded-lg shadow divide-y max-h-72 overflow-y-auto bg-white mt-1">
                        <a class="block p-2 hover:bg-indigo-50" href="#">Tailwind</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Bootstrap</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Foundation</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Bulma</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Material UI</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Semantic UI</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Element UI</a>
                        <a class="block p-2 hover:bg-indigo-50" href="#">Ant Design</a>
                    </div>
                    <!-- end search result -->
                </div>
                <!-- end search example -->
            </div>
            <!-- end search box -->
        </div>
        <!-- end example of centering row items in header  -->
    </header>
</div>
@endsection