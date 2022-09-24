<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Department extends Model
{
    use HasFactory, SoftDeletes, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public $sortable = [
        'id',
        'name',
        'created_at',
    ];

    protected $guarded = [
        'id'
    ];

    // * relations
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // // * scopes
    // public function scopePriceLowerEqual(Builder $query, $price)
    // {
    //     return $query->where('price', '<=', $price);
    // }

    // public function scopePriceHigherEqual(Builder $query, $price)
    // {
    //     return $query->where('price', '>=', $price);
    // }
}
