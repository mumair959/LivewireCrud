<?php

namespace App\Models;

use App\Models\Scopes\AuthUserScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = [];

    function user() {
        return $this->belongsTo(User::class);
    }

    function categories() {
        return $this->belongsToMany(Category::class);
    }

    function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    function shopImages() {
        return $this->hasMany(ShopImage::class);
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new AuthUserScope);
    }
}
