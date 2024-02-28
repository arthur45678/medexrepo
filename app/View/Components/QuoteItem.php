<?php

namespace App\View\Components;

use Illuminate\View\Component;

class QuoteItem extends Component
{

    public $source = "";

    public $sourceTitle = "";

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($source, $sourceTitle = 'Բժիշկ')
    {
        $this->source = $source;
        $this->sourceTitle = $sourceTitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.quote-item');
    }
}
