<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('내 목록보기') }}
        </h2>
    </x-slot>
    <div>
        <table class="table table-hover mt-5">
            <thead>
              <tr>
                <th scope="col">Title</th>
                <th scope="col">Writer</th>
                <th scope="col">Create</th>
                <th scope="col">좋아요 수</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($posts as $post)
              <tr>
                <td><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></td>
                  <td>{{ $post->user->name }}</td>
                  <td>{{ $post->updated_at->diffForHumans() }}</td>
                  {{-- <td>{{ $post->likes->count() }}</td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $posts->links() }}
    </div>

</x-app-layout>
