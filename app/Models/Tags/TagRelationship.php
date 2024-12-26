<?php

namespace App\Models\Tags;


use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TagRelationship extends Model
{

    use HasFactory;

    protected $table = 'tag_relationship';
    protected $fillable = [
        'tag_id', 'folder_id',
    ];

    public function folders(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class);
    }
}
