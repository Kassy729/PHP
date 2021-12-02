<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <div class="card" >
        @if ($car->image)
        <img src="{{ $car->image }}" style="width: 18rem;" class="card-img-top" alt="my post image">
        @else
            <span>첨부 이미지 없음</span>
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $car->name }}</h5>
          <p class="card-text">{{ $car->company->name }}</p>
          <p class="card-text">연도 : {{ $car->year }}</p>
          <p class="card-text">가격 : {{ $car->price }}</p>
          <p class="card-text">타입 : {{ $car->type }}</p>
          <p class="card-text">외형 : {{ $car->style }}</p>

        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">등록일 : {{ $car->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일 : {{ $car->updated_at->diffForHumans() }}</li>
          {{-- <li class="list-group-item">작성자 : {{ $car->user->name }}</li> --}}
        </ul>
      </div>
      <a href="{{ route('cars.index') }}" class="btn btn-primary">돌아가기</a>
        <a href="{{ route('cars.edit', ['car' => $car->id]) }}" class="btn btn-warning">수정</a>
        <a href="{{ route('cars.destroy', ['car' => $car->id]) }}" class="btn btn-danger">삭제</a>
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
