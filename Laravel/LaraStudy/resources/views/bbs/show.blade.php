<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('상세보기') }}
        </h2>
        <button onclick=location.href="{{ route('posts.index') }}">
            목록보기
        </button>
    </div>
    </x-slot>
   <x-post-show :post="$post"></x-post-show>
</x-app-layout>
