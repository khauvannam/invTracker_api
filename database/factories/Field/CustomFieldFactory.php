<?php

namespace Database\Factories\Field;

use App\Models\Field\CustomField;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomFieldFactory extends Factory
{
    protected $model = CustomField::class;

    /**
     * Định nghĩa các thuộc tính mẫu cho mô hình CustomField.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['text', 'number', 'checkbox', 'select']),
            'placeholder' => $this->faker->optional()->word(),
            'default_value' => $this->faker->optional()->word(),
            'applies_to_items' => $this->faker->boolean(),
            'applies_to_folders' => $this->faker->boolean(),
        ];
    }
}

