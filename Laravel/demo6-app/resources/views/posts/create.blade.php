<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('글쓰기 폼') }}
        </h2>
    </div>
    </x-slot>
    <x-post-create></x-post-create>
</x-app-layout>
