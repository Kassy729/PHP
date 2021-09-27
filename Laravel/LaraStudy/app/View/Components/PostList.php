<?php

namespace App\View\Components;

use Illuminate\View\Component;

// 생성자
class PostList extends Component
{
    // 클래스 생성자에서 컴포넌트의 필수 데이터를 정의.
    // 컴포넌트의 모든 공용 속성은 컴포넌트보기에 자동으로 제공.
    public $name = 'agunacoco'; // 변수 선언
    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    // 받은 데이터는 construct에서 사용.
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-list');
    }
}
