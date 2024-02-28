<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class TextField extends Component
{

    public $label;
    public $name;
    public $value;
    public $type;
    public $validationType;
    public $oldDefault;
    public $form;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $label = "",
        string $name,
        string $type = "text",
        $value = "",
        string $validationType = "session",
        string $oldDefault = "",
        string $form = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->validationType = $validationType;
        $this->oldDefault = $oldDefault;
        $this->form = $form;
    }

    /**
     * Get the way the input value is validated
     *
     *
     * @return bool
     */
    public function session(): bool
    {
        return $this->validationType === "session";
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.text-field');
    }
}
