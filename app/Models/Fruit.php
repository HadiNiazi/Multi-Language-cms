<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Fruit extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id', 'fruit_id'];

    public const FRUIT_ID_STARTING_FROM=10000;

    public function scopeEnglishLanguage(Builder $builder)
    {
        $builder->where('language_id', defaultLanguageId());
    }

    public function englishTranslation()
    {
        return $this->hasOne(FruitTranslation::class, 'fruit_id', 'id')->where('language_id', defaultLanguageId());
    }

    public function englishCompletedTranslation()
    {
        return $this->hasOne(FruitTranslation::class, 'fruit_id', 'id')->where('status', FruitTranslation::COMPLETED)->where('language_id', defaultLanguageId());
    }

    public function translation()
    {
        return $this->hasOne(FruitTranslation::class, 'fruit_id', 'id');
    }

    public function translations()
    {
        return $this->hasMany(FruitTranslation::class, 'fruit_id', 'id');
    }

    public function getRouteKeyName(): string
    {
        return 'fruit_id';
    }

}
