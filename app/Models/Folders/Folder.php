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

    protected $fillable = ['name', 'description', 'inventory_id', 'parent_id', 'notes', 'photos','qrcode', 'custom_fields'];
    protected $casts = [
        'photos' => 'array',
        'custom_fields' => 'array',
    ];
    public function child(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
   
}
