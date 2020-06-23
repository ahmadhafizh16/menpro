<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = "jurusan";

    public $timestamps = false;

    protected $appends = ["semester_act"];

    public function getSemesterActAttribute()
    {
        return $this->semester_aktif == 1 ? "Ganjil" : "Genap";
    }

}
