{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h2>게시글 등록하기</h2>
        <form action="/posts/store" method="post">
        @csrf
        <h3>등록할 키워드를 입력하세요</h3>
        <p>
            <label for="title">제목</label>
            <input type="text" id="title" name="title">
        </p>
        <p>
            <label for="content">내용</label>
            <textarea type="text" id="content" name="content"></textarea>
        </p>
        <input type="submit" value="등록">
        </form>
    </div>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <form action="/posts/store" method="post">    
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name = "title" class="form-control" id="title" value="{{ old('title') }}">  {{-- old('title')은 어디서 왔는가??--}}

                @error('title')  {{-- title에 에러가 발생했다면 메세지를 띠우자 --}}
                        <div>{{ $message }}</div>  {{-- $메세지는 어디서 왔는가?? --}}
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control" 
                    id="content" name = "content" >{{ old('content') }}</textarea>

                    @error('content')  {{-- content에 에러가 발생했다면 메세지를 띠우자 --}}
                        <div>{{ $message }}</div>
                    @enderror
            </div>
            <button type="submit" class = "btn btn-primary">Submit</button>
            <a href="./index" class="btn btn-primary">게시글</a>  
            <a href="/" class="btn btn-primary">홈으로</a>  
        </form>
    </div>
</body>
</html>