<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $variant;
    public $size;
    
    /**
     * Create a new component instance.
     */
    public function __construct($type = 'button', $variant = 'primary', $size = 'md')
    {
        $this->type = $type;
        $this->variant = $variant;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.button');
    }
}