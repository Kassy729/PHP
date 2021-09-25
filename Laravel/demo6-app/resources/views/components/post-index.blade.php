<div>
    <table class="table table-hover mt-5">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Writer</th>
            <th scope="col">Create</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
          <tr>
              <td><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></td>
              <td>{{ $post->user->name }}</td>
              <td>{{ $post->updated_at->diffForHumans() }}</td>
          </tr>

          @endforeach
        </tbody>
      </table>
      {{ $posts->links() }}
</div>
