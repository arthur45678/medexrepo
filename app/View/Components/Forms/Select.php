<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $label;
    public $selectName;
    public $options;

    public $validationType;
    public $form;
    public $value;

    public $optionIs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $label = "",
        string $selectName = 'select-name',
        string $options = null,

        string $validationType = "session",
        string $form = null,
        string $value = null,
        string $optionIs = 'id'
    ) {
        $this->label = $label;
        $this->selectName = $selectName;
        $this->options = json_decode($options);

        $this->validationType = $validationType;
        $this->form = $form;
        $this->value = $value;
        $this->optionIs = $optionIs;
    }

    /**
     * Get the way the input value is validated
     *
     * @return bool
     */
    public function session(): bool
    {
        return $this->validationType === "session";
    }

    /**
     * Check the form attribute is exists
     *
     * @return bool
     */
    public function hasForm(): bool
    {
        return $this->form !== null;
    }

    /**
     * Set the form attribute if exists
     *
     * @return string
     */
    public function setFormIfExists(): string
    {
        $hasForm = $this->hasForm();
        return $hasForm ? "form={$this->form}" : "";
    }


    /**
     * check the option is equal to value - is selected.
     *
     * @return bool
     */
    public function isSelected(string $option): bool
    {
        // return $option === $this->value;
        return $option === old($this->selectName, $this->value);
    }

    /**
     * Set the "selected" attribute if the option is equal to value
     *
     * @return string
     */
    public function setSelectedOption($option): string
    {
        $isSelected = $this->isSelected($option);
        return $isSelected ? 'selected' : '';
    }

    /**
     * Defines which property will comes as option
     *
     * @return string
     */
    public function getOption(object $item)
    {
        switch ($this->optionIs) {
            case 'id':
                return $item->id;
            case 'name':
                return $item->name;
            case 'title':
                return $item->tilte;
            case 'label':
                return $item->label;
            default:
                return $item; // need to set from front
        }
    }




    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.select');
    }
}
