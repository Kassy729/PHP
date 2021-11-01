<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('글수정 폼') }}
            </h2>
            <button onclick=location.href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-primary">
                상세보기
            </button>
        </div>
    </x-slot>
    <div class="m-4 p-4">  <!--margin, padding-->
        <form class="row g-3"
            action="{{ route('posts.update', ['post' => $post->id]) }}"
            method="post"
            enctype="multipart/form-data">
        @method('patch')
        @csrf

        <div class="col-12 m-2">
            @if ($post -> image)
                <div class="flex">
                <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="my post image" style="width: 18rem;">
                    <button onclick="return deleteImage()" class="btn btn-danger align-center h-10 mx-2 my-2">이미지 삭제</button>
                </div>
            @else
                <span>첨부 이미지 없음</span>
            @endif
            <label for="image" class="form-label">첨부 이미지</label>
            <input name="image" type="file" class="form-control" id="image">
        </div>

            <div class="col-12 m-2">
                <label for="title" class="form-label">제목</label>
                <input name="title" type="text" class="form-control" id="title" placeholder="제목 입력"
                value="{{ old('title') ? old('title') : $post->title}}">  <!--전에 작성한 정보 저장을 위해-->
                @error('title')
                <div class="text-red-500">
                    <span>{{ $message }}</span>
                </div>
                @enderror
                <!--validate 지정한것을 error 처리한다-->
            </div>


            <div class="col-12 m-2">
                <label for="content" class="form-label">글 내용</label>
                <textarea  name="content" class="form-control" id="content" cols="30">{{ old('content') ? old('content') : $post->content}}</textarea>
                @error('content')
                <div class="text-red-500">
                    <span>{{ $message }}</span>
                </div>
            @enderror
            </div>

            <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">작성</button>
            </div>
        </form>
    </div>
</x-app-layout>
