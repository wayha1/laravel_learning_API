<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'category_brand',
        
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function members():BelongsToMany
    {
        return $this->belongsToMany(User::class, Member::class); 
    }
    
    protected static function booted(): void
    {
        static::addGlobalScope('creator', function(Builder $builder){
            $builder->where('creator_id', Auth::id());
        });
    }
}
