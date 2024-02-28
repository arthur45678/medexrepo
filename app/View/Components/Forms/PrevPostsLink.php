<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class PrevPostsLink extends Component
{
    public $href;
    public $size;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($href = '#', $size='sm')
    {
        $this->href = $href;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.prev-posts-link');
    }
}
