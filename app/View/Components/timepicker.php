<?php

namespace App\View\Components;

use Illuminate\View\Component;

class timepicker extends Component
{
   public $label,$required,$id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $required = false, $id)
    {
        //
      $this->label = $label;
      $this->required = $required ;
      $this->id = $id;
   }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.timepicker');
    }
}
