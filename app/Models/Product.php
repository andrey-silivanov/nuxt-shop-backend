<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Relations\BelongsTo, Relations\BelongsToMany, Relations\HasOne};
use App\Models\EloquentModel;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * Class Product
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\MediaLibrary\Models\Media[] $media
 * @mixin \Eloquent
 */
class Product extends EloquentModel implements HasMedia
{
    use HasMediaTrait;
    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'title',
        'description',
        'price',
        'quantity',
        'color_id',
        'brand_id',
        'phone_model_id',
        'category_id',
        'picture',
        'material_id',
        'tag_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     * @var array
     */
    protected $casts = [];

    /**
     * The relationships that should be touched on save.
     * @var array
     */
    protected $touches = [];

    /**
     * The relations to eager load on every query.
     * @var array
     */
    protected $with = [];

    /**
     * The accessors to append to the model's array form.
     * @var array
     */
    protected $appends = [];

    /**
     * Entity relations go below
     */

    public function color():BelongsTo
    {
        return $this->belongsTo(Color::class);
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand():BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function phoneModel():BelongsTo
    {
        return $this->belongsTo(PhoneModels::class);
    }

    public function material():BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function tags():BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }
    // @todo:

    /**
     * Entity scopes go below
     */

    // @todo:

    /**
     * Entity mutators and accessors go below
     */

    // @todo:

    /**
     * Entity public methods go below
     */
}
