<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use VotableTrait;
    
    protected $fillable=['title','body'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }

    public function favourites(){
        return $this->belongsToMany(User::class,'favourites')->withTimestamps();
    }

    public function setTitleAttribute($value){
        $this->attributes['title']=$value;
        $this->attributes['slug']=str_slug($value);
    }

    public function getUrlAttribute(){
        return route("questions.show",$this->slug);
    }

    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
        //return $this->created_at->format("d-m-Y");
    }

    public function getStatusAttribute(){
        if($this->answers_count>0){
            if($this->best_answer_id)
                return "answered-accepted";
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute(){
        return clean($this->bodyHtml());
    }

    public function getIsFavouritedAttribute(){
        return $this->isFavourited();
    }

    public function getFavouritesCountAttribute(){
        return $this->favourites()->count();
    }

    public function getExcerptAttribute(){
        return $this->excerpt(250);
    }

    private function bodyHtml(){
        return \Parsedown::instance()->text($this->body);
    }

    public function excerpt($length){
        return str_limit(strip_tags($this->bodyHtml()),$length);
    }

    public function acceptBestAnswer(Answer $answer){
        $this->best_answer_id=$answer->id;
        $this->save();
    }

    public function isFavourited(){
        return $this->favourites()->where('user_id',auth()->id())->count()>0;
    }
}
