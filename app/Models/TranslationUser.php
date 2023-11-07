<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TranslationUser extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'translation_user';

    protected $fillable = ['user_id', 'translation_id'];

}
