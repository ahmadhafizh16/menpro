<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = "proposal";

    public $timestamps = false;

    protected $appends = [
        'like_count','is_liked'
    ];

    public function getLikeCountAttribute()
    {
        return $this->liked()->count();
    }

    public function getIsLikedAttribute()
    {
        $like = false;
        if(Auth::check()){
            $like  = $this->liked()->where("proposal_id",$this->id)->where("user_id",Auth::user()->id)->exists();
        }
        return $like;
    }

    public function kelompok()
    {
        return $this->hasOne("App\Kelompok","id_proposal");
    }

    public function history()
    {
        return $this->hasMany("App\ProposalHistory","id_proposal");
    }

    public function liked()
    {
        return $this->hasMany("App\ProposalLiked","proposal_id");
    }

    public function historyLatest()
    {
        return $this->hasMany("App\ProposalHistory","id_proposal")->orderBy("created_at","desc");
    }

}
