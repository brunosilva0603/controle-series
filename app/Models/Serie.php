<?php
namespace App\Models;

use illuminate\Database\Eloquent\Model;
use Storage;

class Serie extends Model{

    public $timestamps = false;
    protected $fillable = ['nome','capa'];

    public function getCapaUrlAttribute(){
        if($this->capa)
        {
            return Storage::url($this->capa);
        }
        return Storage::url('sem-imagem.jpeg');
    }

    public function temporadas()
    {
        return $this->hasMany(Temporada::class);
    }

}