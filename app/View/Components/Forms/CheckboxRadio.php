<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class CheckboxRadio extends Component
{
    public $variant = "variant";
    public $id;
    public $type;
    public $name;
    public $value;
    public $label;
    public $oldDefault;
    public $pos;
    public $check;
    public $form;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $id,
        $type = "radio",
        $name,
        $value,
        $label,
        $oldDefault = null,
        $pos,
        $check = "",
        $form = null
    ) {
        if ($pos === "align") {
            $this->variant = "form-check-inline";
        }
        if($pos === "valign"){
            $this->variant = "form-check-valign";
        }
            $this->id = $id;
            $this->type = $type;
            $this->name = $name;
            $this->value = $value;
            $this->label = $label;
            $this->oldDefault = $oldDefault;
            $this->pos = $pos;
            $this->check = $check;
            $this->form = $form;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.checkbox-radio');
    }
}
