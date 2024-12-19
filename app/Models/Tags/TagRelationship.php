<?php

namespace App\Models\Tags;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Folders\Folder;

class Tag extends Model
{
    use HasFactory;

    // Tên bảng (nếu khác với tên mặc định)
    protected $table = 'tag_relationship';

    // Các cột có thể được gán giá trị
    protected $fillable = [
        'tag_id','folder_id',
    ];


    public function folders()
    {
        return $this->belongsToMany(Folder::class);
    }

    // public function items()
    // {
    //     return $this->belongsToMany(Folder::class);
    // }
}
