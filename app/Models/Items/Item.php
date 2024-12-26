<?php

namespace App\Models\Items;

use App\Models\Folders\Folder;
use App\Models\Tags\Tag;
use App\Models\Field\CustomField;
use App\Models\Field\CustomFieldRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
        'folder_id',
    ];


    protected $casts = [
        'images' => 'array',
    ];


    public function folder(): BelongsTo
    {
        return $this->belongsTo(Folder::class);
    }

        public function tags()
    {
        return $this->belongsToMany(Tag::class, 'item_relationship', 'item_id', 'tag_id');
    }

    public function customFieldRelationships()
    {
        return $this->hasMany(CustomFieldRelationship::class, 'item_id');
    }

    public function customFields()
    {
        return $this->belongsToMany(
            CustomField::class,
            'custom_field_relationships',
            'item_id',
            'custom_field_id'
        )->withPivot('value'); // Truy cập cột `value` trong bảng trung gian
    }
}
