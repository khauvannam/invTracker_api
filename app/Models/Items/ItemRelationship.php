<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tags\Tag;

class ItemRelationship extends Model
{
    use HasFactory;
    protected $table = 'item_relationship';
    protected $fillable = [
        'item_id',
        'tag_id',  // Hoặc 'custom_field_id' nếu liên kết với custom_fields
    ];

    /**
     * Quan hệ với Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    /**
     * Quan hệ với Tag. 
     * Nếu bạn muốn liên kết với CustomField, có thể thay Tag bằng CustomField.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag() // Hoặc 'customField()' nếu bạn liên kết với CustomField
    {
        return $this->belongsTo(Tag::class);  // Hoặc CustomField::class
    }
}
