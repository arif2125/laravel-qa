<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   //Mass assignment -zharif
   protected $fillable = ['title','body'];

   //Relationship between user model        
   public function user(){
       return $this->belongsTo(User::class);
   }

   
    //Mutator.So everytime we enter value, it will do something to Title Attribute
    public function setTitleAttributes($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);

}

}
