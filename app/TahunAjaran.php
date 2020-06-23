<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    protected $table = "tahun_ajaran";

    public $timestamps = false;

    protected $appends = ["semester_act"];

    public function getSemesterActAttribute()
    {
        return $this->semester == 1 ? "Ganjil" : "Genap";
    }
}
