<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Relations\BelongsTo, Relations\HasMany};
use App\Models\EloquentModel;

/**
 * Class Category
 * @package App\Models
 */
class Category extends EloquentModel
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'category_id',
        'parent_id',
        'name',
        'active'
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
    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'category_id');
    }

    /**
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Entity scopes go below
     */

    public function scopeGetParent($query)
    {
        return $query->where('parent_id', 0);
    }

    public function scopePublished($query)
    {
        return $query->whereActive(true);
    }

    /**
     * Entity mutators and accessors go below
     */

    // @todo:

    /**
     * Entity public methods go below
     */

    // @todo:
}
