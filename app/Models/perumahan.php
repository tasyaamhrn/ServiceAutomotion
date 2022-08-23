<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class perumahan extends Model
{
    protected $fillable = [
        'name',
        'address'];
    public $incrementing = false;

    protected $keyType = 'string';
    use HasFactory;
    public static function boot(){
        parent::boot();

        static::creating(function ($issue) {
            $issue->id = Str::uuid(36);
        });
    }
    public function blok(){
        return $this->hasMany(blok::class,'id_perumahan','id');
        }
}
