<?php

namespace App\Models\Field;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Items\Item;
use App\Models\Folders\Folder;
use App\Models\Field\CustomField;

class CustomFieldRelationship extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_field_id',
        'item_id',
        'folder_id',
        'value',
    ];

    
    public function customField()
    {
        return $this->belongsTo(CustomField::class);
    }

    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

   
    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
