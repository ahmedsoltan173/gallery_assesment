<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="images";
    protected $fillable=['name','image','user_id','album_id','create_at','updated_at','deleted_at'];
    protected $hidden=['create_at','updated_at','deleted_at'];

    public function album(){
        return $this->belongsTo(Album::class,'album_id');
    }
}
