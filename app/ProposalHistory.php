<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProposalHistory extends Model
{
    protected $table = "proposal_history";

    protected $appends = ["upload_date"];

    public function getUploadDateAttribute()
    {
        $date1 = explode(" ",$this->created_at);
        $date2 = explode("-",$date1[0]);
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        return $date2[2]." ".$bulan[(int) $date2[1]]." $date2[0] $date1[1]" ;
    }
}
