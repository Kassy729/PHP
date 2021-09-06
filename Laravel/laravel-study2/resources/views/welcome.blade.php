<x-app-layout>
    <x-slot name="header">
        웰컴입니다
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
     <x-post-list :posts=$posts></x-post-list>
</x-app-layout>

