<?php

namespace Database\Factories\Field;

use App\Models\Field\CustomFieldRelationship;
use App\Models\Items\Item;
use App\Models\Field\CustomField;
use App\Models\Folders\Folder;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomFieldRelationshipFactory extends Factory
{
    protected $model = CustomFieldRelationship::class;

    /**
     * Định nghĩa các thuộc tính mẫu cho mô hình CustomFieldRelationship.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'custom_field_id' => CustomField::factory(), 
            'item_id' => Item::factory(), 
            'folder_id' => Folder::factory(), 
            'value' => $this->faker->word(), 
        ];
    }
}
