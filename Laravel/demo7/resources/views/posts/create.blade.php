<x-app-layout>
    <x-slot name="header">
        CREATE
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <form action="{{ route('posts.store') }}"
          method="POST"
          enctype="multipart/form-data">
          @csrf
          <label for="title">제목</label>
          <input type="text" name="title" class="form-control" placeholder="제목입력">

          <label for="content">내용</label>
          <textarea name="content" cols="30" rows="10" placeholder="내용입력" class="form-control"></textarea>

          <div class="input-group mb-3">
            <input name="image" type="file" class="form-control" id="inputGroupFile02">
            <label class="input-group-text" for="inputGroupFile02">Upload</label>
          </div>
          <button type="submit" class="btn btn-primary">작성</button>
    </form>
</x-app-layout>
