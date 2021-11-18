<div>
    <!-- Simplicity is the essence of happiness. - Cedric Bledsoe -->
    @foreach ($cars as $car)
        <div>{{ $car->name }}</div>
    @endforeach
</div>
