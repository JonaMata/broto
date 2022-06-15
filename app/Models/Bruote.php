<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bruote extends Model
{
    use HasFactory;

    protected $fillable = ['bruote', 'author_id', 'placer_id'];

    public function author() {
        return $this->hasOne(User::class, 'id', 'author_id');
    }

    public function placer() {
        return $this->hasOne(User::class, 'id', 'placer_id');
    }
}
