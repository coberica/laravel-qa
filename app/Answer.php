<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable=['body','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function question(){
        return $this->belongsTo(Question::class);
    }

    public function votes(){
        return $this->morphToMany(User::class,'votable');
    }
    
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
        //return $this->created_at->format("d-m-Y");
    }
    
    public function getStatusAttribute(){
        return $this->isBest()?'vote-accepted':'';
    }

    public function getIsBestAttribute(){
        return $this->isBest();
    }

    public function isBest(){
        return $this->id===$this->question->best_answer_id;
    }

    public static function boot(){
        parent::boot();
        
        static::created(function($answer){
            $answer->question->increment('answers_count');
        });

        static::deleted(function($answer){
            $answer->question->decrement('answers_count');
        });
    }
}
