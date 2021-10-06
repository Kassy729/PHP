
@foreach ($posts as $post)
<tr>
    <td><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></td>
    <td>{{ $post->user->name }}</td>
    <td>{{ $post->updated_at->diffForHumans() }}</td>
</tr>

@endforeach
