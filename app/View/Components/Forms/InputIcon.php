<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class InputIcon extends Component
{
    public $icon;
    public $position;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($icon, $position)
    {
        $this->icon = $icon;
        $this->position = $position;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.input-icon');
    }
}
