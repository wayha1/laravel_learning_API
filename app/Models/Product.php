<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_type',
        'product_brand',
        'product_price',
        'product_ingredient',
        'product_stock',
        'is_done',
        'category_id',
    ];

    protected $casts = [
        'is_done' => 'boolean',
    ];

    // protected $hidden = [
    //     'update_at',
    // ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public static function booted(): void
{
    static::addGlobalScope('member', function (Builder $builder) {
        $builder-> where(function ($query) {
            $query->where('creator_id', optional(Auth::user())->id)
                ->orWhereIn('category_id', optional(Auth::user())->memberships->pluck('id')->toArray());
        });
    });
}

}
