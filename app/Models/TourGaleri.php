<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourGaleri extends Model
{
   use HasFactory;
    protected $guarded = [];
    protected $table = 'tour_galeri';

   //  public function store(){
   //    return $this->belongsTo(Store::class);
   // }

   protected $appends = ['foto_url'];


   public function getFotoUrlAttribute() {
     return "http://".request()->getHttpHost().'/uploads/'.$this->foto;
   }
}
