<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MobilRequest extends FormRequest
{
   /**
    * Determine if the user is authorized to make this request.
    *
    * @return bool
    */
   public function authorize()
   {
      return true;
   }

   /**
    * Get the validation rules that apply to the request.
    *
    * @return array<string, mixed>
    */
   public function rules()
   {
      
      if (in_array( $this->request->get('method'), ['PUT', 'PATCH'])) {
         return [
            'plat' => 'required|min:5',
         ];
      }

      if (in_array($this->request->get('method'), ['POST'])) {
         return [
            'plat' => 'required|min:5|unique:mobil',
          
         ];
      }
   }
}
