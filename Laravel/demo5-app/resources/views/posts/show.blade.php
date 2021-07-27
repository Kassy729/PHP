<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="m-5">
            <a href="{{ route('posts.index', ['page'=>$page]) }}">목록보기</a> {{-- page정보를 넘겨 주어서 목록에서 페이지를 유지한다, 라우터 설정할땐 이름으로 --}}


        </div>

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" readonly name = "title" class="form-control" id="title" value="{{ $post->title }}">{{-- input의 name값은 지정한 값으로 해야함 --}} 

        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <div class="form-control" 
                id="content" name = "content" readonly ">{!! $post->content !!}</div>
        </div>
        <div class="form-group">
            <label for="imageFile">Post Image</label>
            <div class="w-10" style="height:50%">
                {{-- <img class="img-thumbnail" width="20%" src="/storage/images/{{ $post->image ?? 'default-image.jpeg'}}"/>  너무 길기 때문에 함수를 만들어서 쉽게 하자 --}}
                <img class="img-thumbnail" width="50%" src="{{ $post->imagePath()}}"/>
            </div>
        </div>
        <div class="form-group">
            <label for="">작성일</label>
            <input type="text" readonly class="form-control" value="{{ $post->created_at }}">
        </div>
        <div class="form-group">
            <label for="">수정일</label>
            <input type="text" readonly class="form-control" value="{{ $post->updated_at }}">
        </div>
        <div class="form-group">
            <label for="">작성자</label>
            <input type="text" readonly class="form-control" value="{{ $post->user->name }}">  
                                                {{-- user테이블과 조인해서 user테이블의 name을 사용 --}}
        </div>
        
        <div class="form-group">
            <label for="content">댓글</label>
            <input type="text" readonly name = "content" class="form-control" id="title" value="{{ $post->comment->id }}">
        </div>

        @auth
        <form action="{{ route('posts.comment', ['id' => $post->id, 'page'=>$page]) }}" method="post" enctype="multipart/form-data">    
            @csrf
            <div class="form-group">
                <input type="text" name = "content" class="form-control" id="content">                  
            </div>
        </form>

          @can('update', $post)
              <div class="flex">
                  <div>
                    <button class="btn btn-warning" onclick="location.href='{{ route('posts.edit', ['post'=>$post->id, 'page'=>$page]) }}'">수정</button>
                  </div>
                  <form action="{{ route('posts.delete', ['id'=>$post->id, 'page'=>$page]) }}" method="post">
                    @csrf
                    @method("delete")
                    <button type="submit" class="btn btn-danger">삭제</button>
                  </form>
              </div>
          @endcan  
        @endauth

    </div>
</body> 

</html>