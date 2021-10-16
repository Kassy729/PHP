<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4" style="width: 30rem">
        @if ($post->image)
            <img src="{{ '/storage/images/' . $post->image }}">
        @else
            <span>첨부이미지 없음</span>
        @endif
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">제목 : {{ $post->title }}</h5>
          <p class="card-text">내용 : {{ $post->content }}</p>
          <div>
            <like-button :post="{{ $post }}" :loginuser="{{ auth()->user()->id }}"/>
          </div>
          <p class="card-text"><small class="text-muted">작성일 : {{ $post->created_at->diffForHumans() }}</small></p>
          <p class="card-text"><small class="text-muted">업데이트일 : {{ $post->updated_at->diffForHumans() }}</small></p>
          <p class="card-text"><small class="text-muted">작성자 : {{ $post->user->name }}</small></p>
          <p class="card-text"><small class="text-muted">좋아요 : {{ $post->likes->count() }} 개</small></p>
        </div>
      </div>
    </div>
    <div class="card-body flex">
        <button onclick="location.href='{{ route('post.edit', ['post' => $post->id]) }}'" class="btn btn-warning">수정</button>
        <form action="{{ route('post.destroy', ['post' => $post, 'page' => $page]) }}"
              method="POST">
            @method('delete')
            @csrf
            <button class="btn btn-danger">삭제</button>
        </form>
    </div>
  </div>
  <div>
      <comment-list :post="{{ $post }}" :loginuser="{{ auth()->user()->id }}"/>
  </div>
