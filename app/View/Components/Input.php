<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id, $label, $required;
    public $type;

    public $value;

    public function __construct($id, $label, $required= false, $type='text', $value='')
    {
      $this->id = $id;
      $this->label = $label;
      $this->required = $required;
       $this->type = $type;
      $this->value = $value;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
