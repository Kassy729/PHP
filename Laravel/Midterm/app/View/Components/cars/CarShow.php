<?php

namespace App\View\Components\Cars;

use Illuminate\View\Component;

class CarShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $car;

    public function __construct($car)
    {
        $this->car = $car;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cars.car-show');
    }
}
