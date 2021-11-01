<x-app-layout>
    <x-slot name="header">
        {{ __('내 목록보기') }}
    </x-slot>
    <x-post-list :posts="$posts"/>
    <div>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <ul class="list-group">
            @foreach ($posts as $post)
                <a href="{{ route('post.show', ['post' => $post->id, 'page' => $posts->currentPage()]) }}"><li class="list-group-item">{{ $post->title }}</li></a>
            @endforeach
          </ul>
    </div>
</x-app-layout>
