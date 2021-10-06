<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<div>
    @foreach ($posts as $post)
    <ul class="list-group">
      <li class="list-group-item"><a href="{{ route('posts.show', ['post' => $post->id, 'page'=>$posts->currentPage()]) }}">{{ $post->title }}</a></li>
    </ul>
    @endforeach
    {{ $posts->links() }}
</div>




