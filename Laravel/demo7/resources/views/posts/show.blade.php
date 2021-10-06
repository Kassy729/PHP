<x-app-layout>
    <x-slot name='header'>
        <h1>Show</h1>
    </x-slot>
    <x-post-show :post='$post' :page='$page'></x-post-show>
</x-app-layout>
