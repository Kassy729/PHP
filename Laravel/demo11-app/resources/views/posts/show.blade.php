<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('작성') }}
        </h2>
        <button onclick=location.href="{{ route('posts.index') }}">
            목록보기
        </button>
    </x-slot>
    <x-post-show :post="$post"/>
    <x-comment-list :post="$post"/>
    <x-comment-create :post="$post"/>
</x-app-layout>
