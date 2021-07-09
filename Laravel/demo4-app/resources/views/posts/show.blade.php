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
            <input type="text" readonly name="title" class="form-control" id="title" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <div class="form-control" id="content" name = "content" readonly>{{ $post->content }}</div>
        </div>

        <div class="form-group">
            <label for="imageFile">Post Image</label>
            <div class="w-10" style="height:50%">
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
            <input type="text" readonly class="form-control" value="{{ $post->user_id }}">  
                                                {{-- user테이블과 조인해서 user테이블의 name을 사용 --}}
        </div>

        
    </div>
</body>
</html>