<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOptionTranslation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'attribute_option_id',
        'locale',
        'value',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'attribute_option_translations';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the attribute option that owns the translation.
     */
    public function attributeOption()
    {
        return $this->belongsTo(AttributeOption::class);
    }
}
