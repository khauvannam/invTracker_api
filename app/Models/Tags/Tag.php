<?php

namespace App\Models\Tags;

use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = ['name', 'items_id', 'folder_id'];

    public function folders(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class);
    }
}
