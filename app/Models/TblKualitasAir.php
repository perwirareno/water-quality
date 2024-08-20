<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblKualitasAir extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tbl_kualitas_air';
    protected $fillable = ['temperatur', 'tds', 'tss', 'ph', 'bod', 'cod', 'do', 'curah_hujan', 'kelas'];
    public $timestamps = false;
}
