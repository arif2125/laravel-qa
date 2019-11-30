<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{

    protected $fillable =['body', 'user_id'];
    
    public function question(){
        return $this->belongsTo(Question::class);

    }


    public function user(){
        return $this->belongsTo(User::class);

    }

    public static function boot(){
        parent::boot();


        static::created(function($answer){
            $answer->question->increment('answers_count');
            $answer->question->save();
        });

        static::deleted(function($answer){

            $question = $answer->question;
            $question->decrement('answer_count');

            if($question->best_answer_id == $answer_id){
                $question->best_answer_id = NULL;
                $question->save();

            }
            $answer->question->decrement('answers_count');
        });
    }

    
    public function getCreatedDateAttribute(){
       return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute(){
        return $this->id == $this->question->best_answer_id ? 'vote-accepted' : '';
    }


 
}
