<div class="m-2 p-2">
    <form class="row g-3"
            action="{{ route('comment.store', ['post_id' => $post->id]) }}"
            method="POST">
                                    <!--파일을 전송할 시에는 enctpye도 작성해야함-->
        @csrf
        <div class="col-12 m-2" flex>
            <input name="comment" type="text" class="form-control" id="title" placeholder="댓글 입력"
            value="{{ old('comment') }}">  <!--전에 작성한 정보 저장을 위해-->
            @error('comment')
            <div class="text-red-500">
                <span>{{ $message }}</span>
            </div>
            @enderror
            <!--validate 지정한것을 error 처리한다-->
            <button class="btn btn-primary">작성</button>
        </div>
    </form>
</div>
