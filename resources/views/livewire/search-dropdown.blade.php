<div class="relative">
    <input wire:model.debounce.300ms='search' type="search" value="Framework"
        class="w-full rounded-lg border border-gray-200 h-10 p-5 focus-visible:outline-indigo-800" autocomplete="off"
        placeholder="Search" />
    <!-- search result -->
    @if (strlen($search) > 1)
    <div class="absolute z-10 w-full border rounded-lg shadow divide-y overflow-y-auto bg-white mt-1">
        @forelse ($searchResults as $result)
        <a class="flex justify-start p-1 cursor-pointer hover:bg-indigo-50" href="{{ $result['trackViewUrl'] ?? "" }}"
            target="_blank">
            <img class="rounded w-1/6" src="{{ $result['artworkUrl60'] }}" alt="image">
            <div class="p-2 w-5/6">
                <div class="align-middle p-2 text-lg pt-3 pb-0">{{ $result['trackName'] ?? "" }}</div>
                <small class="block text-xs pl-2 text-gray-600">{{ $result['artistName'] ?? "Unknown Artist" }}</small>
            </div>
        </a>
        @empty
        <div class="p-4">No Results Found For "{{ $search }}"</div>
        @endforelse
    </div>
    @endif
    <!-- end search result -->
</div>