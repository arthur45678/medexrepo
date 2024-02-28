<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class MagicSearch extends Component
{
    // public $dataId;
    public $hiddenId;
    public $hiddenName;

    public $placeholder;
    public $class;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $hiddenId, // = 'id-of-hidden-input',
        string $hiddenName, // = 'hidden-input-name',

        string $class = "", // = 'magic-search',
        string $placeholder = "", // = 'magic placeholder...',
        $value = null
    ) {
        $this->hiddenId = $hiddenId;
        $this->hiddenName = $hiddenName;

        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.magic-search');
    }
}
