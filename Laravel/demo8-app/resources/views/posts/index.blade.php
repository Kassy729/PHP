<x-app-layout>
    <x-slot name="header">
        {{ __('목록보기') }}
    </x-slot>
    <x-post-list :posts="$posts"/>
    {{ $posts->links() }}
</x-app-layout>
