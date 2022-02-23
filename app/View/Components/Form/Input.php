<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public $type, 
        public $id, 
        public $title, 
        public $placeholder, 
        public $name = null, 
        public $model = null, 
        public $error = null, 
        public $step = null, 
        public $disabled = false
    ) {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.input');
    }
}
