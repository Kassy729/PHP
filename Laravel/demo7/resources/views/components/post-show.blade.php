<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<div class="card" style="width: 18rem;">
    @if ($post->image)
        <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="...">
    @else
    <span>첨부 이미지 없음</span>
    @endif
    <div class="card-body">
      <h5 class="card-title">제목 : {{ $post->title }}</h5>
      <p class="card-text">내용 : {{ $post->content }}</p>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">작성자 : {{ $post->user->name }}</li>
      <li class="list-group-item">게시일 : {{ $post->created_at }}</li>
      <li class="list-group-item">업데이트 : {{$post->updated_at->diffForHumans()}}</li>
    </ul>
    <div class="card-body flex">
            <button onclick="location.href='{{ route('posts.edit', ['post' => $post->id]) }}'" type="submit" class="btn btn-warning">수정</button>
        <form action="{{ route('posts.destroy', ['post' => $post->id]) }}"
              method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">삭제</button>
        </form>
    </div>
  </div>
