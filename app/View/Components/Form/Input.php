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
        public string $type,
        public string $id,
        public string $title,
        public string $placeholder,
        public string|null $name = null,
        public string|null $model = null,
        public string|null $error = null,
        public string|null $step = null,
        public bool $disabled = false
    ) {
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
