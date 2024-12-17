<?php

namespace App\Models\Folders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'inventory_id', 'parent_id'];

    public function child(): HasMany
    {
        return $this->hasMany(folder::class, 'parent_id');
    }
}