<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    // Tên bảng (nếu khác với tên mặc định)
    protected $table = 'tags';

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'name',
    ];

    public function tagRelationship(): HasMany
    {
        return $this->hasMany(TagRelationship::class);
    }

    // public function items()
    // {
    //     return $this->belongsToMany(Folder::class);
    // }
}
