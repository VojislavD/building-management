<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Input extends Component
{
    public $type;
    public $id;
    public $title;
    public $placeholder;
    public $name;
    public $model;
    public $step;
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $id, $title, $placeholder, $name = null, $model = null, $step = null, $disabled = false)
    {
        $this->type = $type;
        $this->id = $id;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->model = $model;
        $this->step = $step;
        $this->disabled = $disabled;
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
