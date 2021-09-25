<div class="m-4 p-4">
    <form class="row g-3"
    action="{{ route('posts.store') }}"
    method="POST"
    enctype="multipart/form-data">
    @csrf
        <div class="col-12 m-2">
            <label for="title" class="form-label">제목</label>
            <input name="title" type="text" class="form-control" id="title" placeholder="제목 입력"
            value="{{ old('title') }}">  <!--전에 작성한 정보 저장을 위해-->
            @error('title')
            <div class="text-red-500">
                <span>{{ $message }}</span>
            </div>
            @enderror
            <!--validate 지정한것을 error 처리한다-->
        </div>

        <div class="col-12 m-2">
            <label for="content" class="form-label">내용</label>
            <textarea name="content" id="content" class="form-control">{{ old('content') }}</textarea>
            @error('content')
                <div>
                    <span>{{ $message }}</span>
                </div>
            @enderror
        </div>

        <div class="col-12 m-2">
            <label for="image" class="form-label">첨부 이미지</label>
            <input name="image" type="file" class="form-control" id="image">
        </div>

        <div class="col-12 m-2">
            <button type="submit" class="btn btn-primary">작성</button>
        </div>
    </form>
</div>
