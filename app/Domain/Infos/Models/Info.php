<?php

namespace App\Domain\Infos\Models;

use App\Domain\Categories\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'url',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
