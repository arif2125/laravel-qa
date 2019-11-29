<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   //Mass assignment -zharif
   protected $fillable = ['title','body','slug'];

   //Relationship between user model        
   public function user(){
       return $this->belongsTo(User::class);
   }

   
    //Mutator.So everytime we enter value, it will do something to Title Attribute
    public function setTitleAttribute($value){
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value);

    }

    public function getUrlAttribute(){
        return route('questions.show',$this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }


    public function answers(){
        return $this->hasMany(Answer::class);

    }





}
