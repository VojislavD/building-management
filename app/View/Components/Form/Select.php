<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $id;
    public $title;
    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $title, $options)
    {
        $this->name = $name;
        $this->id = $id;
        $this->title = $title;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select');
    }
}
