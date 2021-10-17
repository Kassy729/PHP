<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('작성') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <form action="{{ route('post.store') }}"
          method="POST"
          enctype="multipart/form-data">
          @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">제목</label>
            <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="제목">
          </div>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">내용</label>
            <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Default file input example</label>
            <input name="image" class="form-control" type="file" id="formFile">
          </div>
        <button class="btn btn-primary" type="submit">작성</button>
    </form>
</x-app-layout>

