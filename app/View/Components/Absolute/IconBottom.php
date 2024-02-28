<?php

namespace App\View\Components\Absolute;

use Illuminate\View\Component;

class IconBottom extends Component
{
    public $title;
    public $xpos;
    public $icon;
    public $iconClass;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = '', $xpos = '', $icon = 'icon', $iconClass = 'c-x16', $type = 'html')
    {
        $this->title = $title;
        $this->xpos = $xpos;
        $this->icon = $icon;
        $this->iconClass = $iconClass;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.absolute.icon-bottom');
    }
}
