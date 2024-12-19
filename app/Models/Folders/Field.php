<?php

namespace App\Models\Folders;

use App\Models\Tags\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['Serial Number', 'Model/Part Number', 'inventory_id', 'parent_id', 'Purchase Date', 'Expiry Date','Size'];
    
    public function child(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
   
}
