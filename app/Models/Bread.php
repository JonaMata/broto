<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Bread extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'special_ingredient', 'huts', 'rating', 'bake_date'];

    protected $dates = ['bake_date'];

    public function photo() {
        if ($this->photo_path == null) return null;
        return route('breads::photo', ['bread' => $this->id]);
    }

    public function addPhoto(UploadedFile $photo) {
        if($this->photo_path != null) {
            $this->deletePhoto();
        }
        $folder = 'bread-photos';
        $path = Storage::putFile($folder, $photo);
        $this->photo_path = $path;
        $this->save();
    }

    public function deletePhoto() {
        Storage::delete($this->photo_path);
        $this->photo_path = null;
        $this->save();
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function($bread) {
            $bread->deletePhoto();
        });
    }
}
