<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelompok extends Model
{
    protected $table = "data_kelompok";

    public $timestamps = false;

    public function mhs()
    {
        return $this->belongsToMany('App\User', 'detail_kelompok', 'id_kelompok', 'id_user');
    }

    public function dosen()
    {
        return $this->belongsTo("App\User","id_dosbing");
    }

    public function kelas()
    {
        return $this->belongsTo("App\Kelas","id_kelas");
    }

    public function proposal()
    {
        return $this->belongsTo("App\Proposal","id_proposal");
    }
}
