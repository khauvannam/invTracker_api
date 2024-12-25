<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TagRelationship extends Model
{
    use HasFactory;

    // Tên bảng (nếu khác với tên mặc định)
    protected $table = 'tag_relationship';

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'tag_id','folder_id',
    ];


    public function folders(): hasMany
    {
        return $this->hasMany(Folder::class);
    }

    // public function items()
    // {
    //     return $this->belongsToMany(Folder::class);
    // }
}
