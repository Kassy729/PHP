<x-app-layout>
    <x-slot name="header">
        Index
    </x-slot>
    <x-post-list :posts="$posts"/>
    {{ $posts->links() }}
</x-app-layout>
