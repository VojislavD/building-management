<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $name;
    public $id;
    public $title;
    public $placeholder;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $id, $title, $placeholder)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->title = $title;
        $this->placeholder = $placeholder;
    }

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
