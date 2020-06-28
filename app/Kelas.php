<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";

    public $timestamps = false;

    public function dosen()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function tahun()
    {
        return $this->belongsTo('App\TahunAjaran', 'id_tahunajaran');
    }

    public function jurusan()
    {
        return $this->belongsTo('App\Jurusan', 'id_jurusan');
    }
}
