<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'price_before_discount',
        'features',
        'comments',
    ];

    protected $casts = [
        'features' => 'array',
        'comments' => 'array',
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('front_thumb')
            ->fit(Fit::Crop, 450, 300);

        $this->addMediaConversion('front_large')
            ->fit(Fit::Crop, 600);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function size(): BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'inventory_items')->withPivot('quantity');
    }

    public function color(): BelongsToMany
    {
        return $this->belongsToMany(Color::class, 'inventory_items')->withPivot('quantity');
    }

    public function inventoryItems(): HasMany
    {
        return $this->hasMany(InventoryItem::class);
    }
}
