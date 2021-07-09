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
    <div class="container mt-5 mb-5">
    <a href="{{ route('dashboard') }}">Dashboard</a>  {{-- 라라벨에서 함수 사용할시에 {{  }}사용 --}}
    <h1>게시글 리스트</h1>
    @auth
        <a href="/posts/create" class="btn btn-primary">게시글 작성</a>  {{-- 게시글 작성할수있도록 create 버튼 생성 --}}
    @endauth
    <a href="/" class="btn btn-primary">홈으로</a>  
        <ul class="list-group">  {{-- blade 문법으로 작성 리스트를 값에 따라 동적으로 생성 --}}
            @foreach ($posts as $post)  
                <li class="list-group-item">
                    <span>
                        <a href="{{ route('post.show', ['id'=>$post->id, 'page'=>$posts->currentPage()]) }}">   {{-- currentPage 전역메소드 --}}
                            {{-- 상세보기하기 위해 post.show링크 달기, 페이지 정보 도 넘겨주기 --}}
                        제목 : {{ $post->title }}
                        </a> 

                    </span>  {{-- 컨트롤러로 부터 받은 $posts값을 속성을 이용해 빼서 사용 --}}
                    
                    {{-- <div>
                        내용 : {{ $post->content }}
                    </div> --}}
                    <span>작성일 : {{ $post->created_at->diffForHumans() }}
                        {{ $post->count }} {{ $post->count > 0 ? Str::plural('view', $post->count) : 'view' }}
                    </span> 
                    <hr>
                </li>
            @endforeach
            
          </ul>
        <div class="mt-5">
            {{ $posts->links() }}  {{-- 페이지 넘기는 버튼 --}}
        </div>
    </div>
</body>
</html>