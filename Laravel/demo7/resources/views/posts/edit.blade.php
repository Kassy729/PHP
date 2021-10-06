<x-app-layout>
    <x-slot name='header'>
        <h1>edit</h1>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <form action="{{ route('posts.update', ['post'=>$post->id]) }}"
          method="post"
          enctype="multipart/form-data">

        @method('patch')
        @csrf
        <div class="card" style="width: 18rem;">
            {{-- <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="..."> --}}
            <div class="col-12 m-2">
                @if ($post -> image)
                    <div class="flex">
                    <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="my post image" style="width: 18rem;">
                    </div>
                @else
                    <span>첨부 이미지 없음</span>
                @endif
                <input name="image" type="file" class="form-control" id="image">
            </div>
            <div class="card-body">
                <label for="title">제목</label>
                <input type="text" name="title" class="card-title" value="{{ $post->title }}">
                <label for="content">내용</label>
                <input type="text" name="content" class="card-text" value="{{ $post->content }}">
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">작성자 : {{ $post->user->name }}</li>
              <li class="list-group-item">게시일 : {{ $post->created_at }}</li>
              <li class="list-group-item">업데이트 : {{$post->updated_at}}</li>
            </ul>
            <button type="submit" class="btn btn-success">제출</button>
          </div>
        </div>
    </form>
</x-app-layout>
