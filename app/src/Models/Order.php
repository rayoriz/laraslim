<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the region relation
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function region()
    {
        return $this->hasOne(\App\Models\Region::class);
    }

    /**
     * Return the orderline relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderline()
    {
        return $this->hasMany(\App\Models\Orderline::class);
    }
}