<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between" id="app">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
        </h2>
        <button onclick=location.href="{{ route('posts.create') }}" type="button" class="btn btn-info hover:bg-blue-700 font-bold text-white">
            글쓰기
        </button>
    </div>
    </x-slot>

    {{-- 컴포넌트가 등록되면 별칭태그을 사용하여 렌더링 될 수 있다. --}}
    {{-- 블레이드 컴포넌트 태그는 문자열 x-로 시작하고 그 뒤에 컴포넌트 클래스의 케밥 케이스 형태의 이름이 온다. --}}
    {{-- 컴포넌트에 데이터를 전달하는 방법은 :을 접두사로 한 속성을 통해 컴포넌트에 전달되어야 한다 --}}
    {{-- app/View/Components로 전달된다. --}}
    <x-post-list :posts="$posts" />
</x-app-layout>
