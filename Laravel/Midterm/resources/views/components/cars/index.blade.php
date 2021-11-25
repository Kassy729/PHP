<x-guest-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <div>
        <a href="{{ route('cars.create') }}" class="btn btn-primary">자동차 등록</a>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">제조회사</th>
            <th scope="col">자동차명</th>
            <th scope="col">제조연도</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($cars as $car)
            <tr>
                <td>{{ $car->company->name }}</td>
                <td>{{ $car->name }}</td>
                <td>{{ $car->year }}</td>
              </tr>
            @endforeach
        </tbody>
      </table>
        <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
        <div>
            {{ $cars->links() }}
        </div>
</x-guest-layout>
