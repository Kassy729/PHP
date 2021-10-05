<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

<div class="row row-cols-4 row-cols-md-3 g-4">
@foreach ($posts as $post)
    <div class="col">
      <div class="card h-100">
        <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="my post image">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
        </div>
        <div class="card-footer">
          <small class="text-muted">{{ $post->created_at }}</small>
        </div>
      </div>
    </div>
</div>
@endforeach

