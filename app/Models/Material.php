<?php
declare(strict_types = 1);

namespace App\Models;

use Illuminate\Database\Eloquent\{Builder, Relations\HasOne};
use App\Models\EloquentModel;

/**
 * Class Material
 * @package App\Models
 */
class Material extends EloquentModel
{
    /**
     * @var string
     */
    protected $table = 'materials';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name', 'active'
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
     * @return HasOne
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
