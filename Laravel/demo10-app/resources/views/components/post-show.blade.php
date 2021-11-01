<div class="card" >
        @if ($post->image)
        <img src="{{ '/storage/images/'.$post->image }}" style="width: 18rem;" class="card-img-top" alt="my post image">
        @else
            <span>첨부 이미지 없음</span>
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">등록일 : {{ $post->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일 : {{ $post->updated_at->diffForHumans() }}</li>
          <li class="list-group-item">작성자 : {{ $post->user->name }}</li>
        </ul>
        @auth
            @if (auth()->user()->id == $post->user_id)
            <div class="card-body flex">
                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-warning">수정하기</a>
                <form id="form" class="ml-4" method="post" onsubmit="event.preventDefault(); confirmDelete()">
                    @csrf
                    @method('delete')
                    {{-- <input type="hidden" name="_method" value="delete"> --}}
                    <button class="btn btn-danger" type="submit">삭제하기</button>
                </form>
            </div>
            @endif
        @endauth
      </div>
      <div>
        <comment-index :post="{{ $post }}" :loginuser="{{ auth()->user()->id }}"/>
      </div>
      <div>
        <comment-create :post="{{ $post }}"/>
      </div>
    </div>
      <script type="application/javascript">
          function confirmDelete(e){
              myform = document.getElementById('form');
              flag = confirm('정말 삭제하시겠습니까?');
              //확인 취소를 물어보는 함수
              if(flag){
                  //서브밋...
                  myform.submit();
              }
            //   e.preventDefault();  //form이 서버로 전달되는 것을 막아준다.
          }
      </script>
</div>
