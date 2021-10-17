<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('수정') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <div class="col-md-4">
        @if ($post->image)
            <img src="{{ '/storage/images/'.$post->image }}" class="img-fluid rounded-start" alt="...">
        @else
            <span>첨부이미지가 없습니다.</span>
        @endif
    </div>
    <form action="{{ route('post.update', ['post' => $post->id]) }}"
          method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('patch')
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input name="image" class="form-control" type="file" id="formFile">
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">제목</label>
            <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="제목" value="{{ old('title') ? old('title') : $post->title }}">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">내용</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('content') ? old('content') : $post->content }}</textarea>
        </div>
        <button class="btn btn-success" type="submit">제출</button>
    </form>
</x-app-layout>
