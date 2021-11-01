<div>
    <label for="exampleFormControlInput1" class="form-label">댓글</label>
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th scope="col">내용</th>
                    <th scope="col">작성자</th>
                    <th scope="col">수정</th>
                    <th scope="col">삭제</th>
                </tr>
            </thead>
            @foreach ($post->comments as $comment)
                <tbody>
                    <tr>
                        <td>{{ $comment->comment }}</td>
                        <td>{{$comment->user->name }}</td>
                        @auth
                        @if (auth()->user()->id == $comment->user_id)
                        <td>
                            <button class="btn btn-warning">
                                수정
                            </button>
                        </td>
                        <td>
                            <form id="form" class="ml-4" method="post" onsubmit="event.preventDefault(); confirmDelete()">
                                @csrf
                                @method('delete')
                                {{-- <input type="hidden" name="_method" value="delete"> --}}
                                <button class="btn btn-danger" type="submit">삭제</button>
                            </form>
                        </td>
                        @endif
                        @endauth
                    </tr>
                </tbody>
            @endforeach
        </table>

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
