<?php

namespace App\Models\Field;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Items\Item;
use App\Models\Folders\Folder;
class CustomField extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'placeholder',
        'default_value',
        'applies_to_items',
        'applies_to_folders',
    ];

   
    public function items()
    {
        return $this->belongsToMany(Item::class, 'custom_field_relationships')
                    ->withPivot('value');
    }

    
    public function folders()
    {
        return $this->belongsToMany(Folder::class, 'custom_field_relationships')
                    ->withPivot('value');
    }
}
