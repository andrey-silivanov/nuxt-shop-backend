<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Relations\BelongsTo, Relations\HasOne};
use App\Models\EloquentModel;

/**
 * Class Color
 * @package App\Models
 */
class Color extends EloquentModel
{
    /**
     * @var string
     */
    protected $table = 'colors';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'active'
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

    public function product():HasOne
    {
        return $this->hasOne(Product::class);
    }

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

    // @todo:
}
