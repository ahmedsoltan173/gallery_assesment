<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="albums";
    protected $fillable=['name','user_id','create_at','updated_at','deleted_at'];
    protected $hidden=['create_at','updated_at','deleted_at'];


    public function images(){
        return $this->hasMany(Image::class);
    }
}
