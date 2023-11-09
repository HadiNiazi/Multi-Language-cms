<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Language extends Model
{
    use HasFactory;

    public const LTR = 0;
    public const RTL = 1;

    protected $fillable = ['code', 'name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'fruit_language_user');
    }
}
