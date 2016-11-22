<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orderline extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the region for the order.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }

    /**
     * Return the organisation relation
     * 
     * @return 
     */
    public function organisation()
    {
        return $this->belongsTo(\App\Models\Organisation::class);
    }

    /**
     * Return the book relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function book()
    {
        return $this->belongsTo(\App\Models\Book::class);
    }

    /**
     * Return the order relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(\App\Models\Order::class);
    }
}