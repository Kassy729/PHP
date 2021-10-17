<div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">제목</th>
            <th scope="col">작성자</th>
            <th scope="col">좋아요</th>
            <th scope="col">작성일</th>
          </tr>
        </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                <th scope="row">1</th>
                <td><a href="{{ route('post.show', ['post' => $post->id, 'page' => $posts->currentPage()]) }}">{{ $post->title }}</a></td>
                <td>{{ $post->user->name }}</td>
                <td>좋아요</td>
                <td>{{ $post->created_at }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{ $posts->links() }}
</div>
