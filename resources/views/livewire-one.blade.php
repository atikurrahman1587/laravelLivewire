@extends('layouts.app')
@section('content')
    <h2>Livewire One</h2>
    <livewire:counter/>
    <livewire:search-component/>

    <livewire:post-show :post="1" />
    <livewire:post-show :post="2" />
    <livewire:first-component/>

    <livewire:second-component/>

    <div class="bg-white p-4 mt-6">
        <livewire:message-component />
    </div>
@endsection