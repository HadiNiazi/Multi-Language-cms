<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Vegetable extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function translation(): MorphMany
    {
        return $this->morphMany(Translation::class, 'transable');
    }

    public function gallery(): MorphOne
    {
        return $this->morphOne(Gallery::class, 'imageable');
    }
}
