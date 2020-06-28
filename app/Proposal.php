<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $table = "proposal";

    public $timestamps = false;

    public function history()
    {
        return $this->hasMany("App\ProposalHistory","id_proposal");
    }

}
