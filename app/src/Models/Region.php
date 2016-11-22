<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Return the organisation relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function organisation()
    {
        return $this->hasMany(\App\Models\Organisation::class);
    }

    /**
     * Return the books relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books()
    {
        return $this->hasMany(\App\Models\Book::class);
    }
}