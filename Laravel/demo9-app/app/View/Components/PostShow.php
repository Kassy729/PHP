<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostShow extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $post;
    public $page;

    public function __construct($post, $page)
    {
        $this->post = $post;
        $this->page = $page;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-show');
    }
}
