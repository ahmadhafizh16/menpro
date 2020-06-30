<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = "proposal";

    public $timestamps = false;

    public function kelompok()
    {
        return $this->hasOne("App\Kelompok","id_proposal");
    }

    public function history()
    {
        return $this->hasMany("App\ProposalHistory","id_proposal");
    }

    public function historyLatest()
    {
        return $this->hasMany("App\ProposalHistory","id_proposal")->orderBy("created_at","desc");
    }

}
