<?php

namespace App\Models\Folders;

use App\Models\Tags\TagRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'inventory_id', 'parent_id', 'notes', 'qr_code'];

    public function child(): HasMany
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(TagRelationship::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function setCustomFields(array $fields): void
    {
        $this->custom_fields = json_encode($fields);
        $this->save();
    }

    public function getCustomFields(): array
    {
        return json_decode($this->custom_fields, true) ?? [];
    }
}
