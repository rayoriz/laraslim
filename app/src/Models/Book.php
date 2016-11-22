<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'region',
        'rayon',
        'cover',
        'coverPage',
        'results',
        'opt1',
        'opt2',
        'opt3',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the info that this model needs to return
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function getInfo($info = null)
    {
        
        return $this->with('region');
    }

    /**
     * Return the organisation relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organisation()
    {
        return $this->belongsTo(\App\Models\Organisation::class);
    }

    /**
     * Return the region relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }
}