<x-app-layout>
    <x-slot name="header">
        Edit
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <div class="col-md-4" style="width: 30rem">
        @if ($post->image)
            <img src="{{ '/storage/images/'.$post->image }}" class="img-fluid rounded-start" alt="...">
        @else
            <span>첨부이미지 없음</span>
        @endif
    </div>
    <form action="{{ route('post.update', ['post' => $post->id]) }}"
          method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('patch')
            <div class="input-group mb-3">
                <input name="image" type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">제목</label>
                <input type="text" name="title" class="form-control" id="exampleFormControlInput1" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">내용</label>
                <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="3">{{ $post->content }}</textarea>
            </div>
            <button class="btn btn-primary" type="submit">작성</button>
    </form>

</x-app-layout>
