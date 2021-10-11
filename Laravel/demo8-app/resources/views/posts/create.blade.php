<x-app-layout>
    <x-slot name="header">
        Create
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <form action="{{ route('post.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">제목</label>
            <input type="title" class="form-control"
            name="title"
            placeholder="제목">
          </div>
          <div class="mb-3">
            <label for="content" class="form-label"></label>내용</label>
            <textarea class="form-control"
            name="content" rows="3"></textarea>
          </div>
          <div class="input-group mb-3">
            <input type="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <button class="btn btn-primary">작성</button>
    </form>
</x-app-layout>
