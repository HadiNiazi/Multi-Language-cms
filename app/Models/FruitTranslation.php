<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;

class FruitTranslation extends Model
{
    use HasFactory, Searchable;

    public const PENDING = 0;
    public const IN_PROGRESS = 1;
    public const COMPLETED = 2;
    public const YES = 1;
    public const NO = 0;

    protected $table = 'fruit_translations';

    protected $fillable = [
        'fruit_id', 'language_id', 'title_1', 'title_2', 'title_3', 'heading_title_1', 'heading_title_2',
        'heading_title_3', 'description_1', 'description_2', 'description_3', 'images', 'is_visible', 'status',
        'created_by', 'updated_by', 'translation_id'
    ];

    public function toSearchableArray()
    {
        return [
            'title_1' => $this->title_1,
            'heading_title_1' => $this->heading_title_1,
            'description_1' => $this->description_1,

            'title_2' => $this->title_2,
            'heading_title_2' => $this->heading_title_2,
            'description_2' => $this->description_2,

            'title_3' => $this->title_3,
            'heading_title_3' => $this->heading_title_3,
            'description_3' => $this->description_3,
        ];
    }

    public function fruit()
    {
        return $this->belongsTo(Fruit::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
