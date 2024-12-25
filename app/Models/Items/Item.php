<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    
    protected $fillable = [
        'name',
        'quantity',
        'alert',
        'price',
        'images',
        'notes',
        'field',
        'folder_id',
    ];

   
    protected $casts = [
        'images' => 'array',
        'field' => 'array',
    ];

   
    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

    
    // public function tags(): BelongsToMany
    // {
    //     return $this->belongsToMany(Tag::class, 'item_tag', 'item_id', 'tag_id');
    // }
}
