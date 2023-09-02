<div>
    <h2 class="text-xl text-gray-500">Search Form</h2>
    <input wire:model.defer="searchText" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text">
    <br/>
    <button wire:click="searchBtn" class="bg-gray-500 px-3 py-2 text-white rounded">Search</button>
    <br/>
    {{ $searchText }}
</div>
