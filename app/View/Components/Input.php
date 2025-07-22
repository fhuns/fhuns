<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $id;
    public $value;
    public $placeholder;
    public $required;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $type = 'text',
        $name = null,
        $id = null,
        $value = null,
        $placeholder = null,
        $required = false
    ) {
        $this->type = $type;
        $this->name = $name ?? $this->type;
        $this->id = $id ?? $this->name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.input');
    }
}