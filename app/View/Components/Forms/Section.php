<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Section extends Component
{

    public $title;
    public $viewUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = "", string $viewUrl = "")
    {
        $this->title = $title;
        $this->viewUrl = $viewUrl;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.section');
    }
}
