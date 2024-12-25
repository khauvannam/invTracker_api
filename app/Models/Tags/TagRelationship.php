<?php

namespace App\Models\Tags;

use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TagRelationship extends Model
{

    protected $table = 'tag_relationship';

    protected $fillable = [
        'tag_id', 'folder_id',
    ];


    public function folders(): BelongsToMany
    {
        return $this->belongsToMany(Folder::class);
    }

    // public function items()
    // {
    //     return $this->belongsToMany(Folder::class);
    // }
}
