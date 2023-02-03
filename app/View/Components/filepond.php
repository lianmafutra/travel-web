<?php

namespace App\View\Components;

use Illuminate\View\Component;

class filepond extends Component
{
   public $id;
   public $label;
   public $max;
   public $required;
   public $info;




   /**
    * Create a new component instance.
    *
    * @return void
    */
   public function __construct( $label, $required, $info='')
   {
      //
     
      $this->label = $label;
      $this->required = $required;
      $this->info = $info;
    
   }



   /**
    * Get the view / contents that represent the component.
    *
    * @return \Illuminate\Contracts\View\View|\Closure|string
    */
   public function render()
   {
      return view('components.filepond');
   }
}
