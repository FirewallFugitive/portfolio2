<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ClothingItem;

class Outfit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'clothing_item_ids',
        'isPublic',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getClothingItemsAttribute()
    {
        $ids = json_decode($this->clothing_item_ids, true);

        if (!is_array($ids)) {
            return collect();
        }

        return ClothingItem::whereIn('id', $ids)->get();
    }

}
