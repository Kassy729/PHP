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
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
          <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
          <p class="card-text"><small class="text-muted">{{ $post->updated_at->diffForHumans() }}</small></p>
          <p class="card-text"><small class="text-muted">{{ $post->user->name }}</small></p>
        </div>
      </div>
    </div>
    <div class="card-body flex">
        <button onclick="location.href='{{ route('post.edit', ['post' => $post->id]) }}'" class="btn btn-warning">수정</button>
        <button class="btn btn-danger">삭제</button>
    </div>

  </div>
