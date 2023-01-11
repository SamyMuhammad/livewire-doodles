<div class="relative">
    <input wire:model.debounce.300ms='search' type="search" value="Framework" class="w-full rounded-lg border border-gray-200 h-10 p-5 focus-visible:outline-indigo-800"
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
