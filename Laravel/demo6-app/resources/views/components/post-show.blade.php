<div>
    <div class="card" style="width: 18rem;">
        @if ($post -> image)
            <img src="{{ '/storage/images/'.$post->image }}" class="card-img-top" alt="my post image">
        @else
            <span>첨부 이미지 없음</span>
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">등록일 : {{ $post->created_at->diffForHumans() }}</li>
            <li class="list-group-item">수정일 : {{ $post->created_at->diffForHumans() }}</li>
            <li class="list-group-item">작성자 : {{ $post->user->name }}</li>
        </ul>
        <div class="card-body flex">
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="card-link">수정하기</a>
            <form id="form" class="ml-4" method="post" onsubmit="event.preventDefault(); confirmDelete()">
                @csrf
                @method('delete')
                <button type="submit">삭제하기</button>
            </form>
        </div>
    </div>
    <script>
        function confirmDelete(e){
            myform = document.getElementById('form');
            flag = confirm('정말 삭제하시겠습니까?');
            if(flag){
                myform.submit();
            }
        }
    </script>

</div>
