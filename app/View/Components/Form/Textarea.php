<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $id;
    public $title;
    public $placeholder;
    public $name;
    public $model;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $title, $placeholder, $name = null, $model = null, $value = null)
    {
        $this->id = $id;
        $this->title= $title;
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->model = $model;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.textarea');
    }
}
