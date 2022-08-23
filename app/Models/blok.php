<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class blok extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_perumahan',
        'name',
    'denah'];
        public $incrementing = false;
        protected $keyType = 'string';
        public static function boot(){
            parent::boot();

            static::creating(function ($issue) {
                $issue->id = Str::uuid(36);
            });
        }
        public function perumahan(){
            return $this->belongsTo(perumahan::class,'id_perumahan');
        }
        public function product(){
            return $this->hasMany(Product::class,'blok','id');
            }
}
