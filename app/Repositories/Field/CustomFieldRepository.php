<?php

namespace App\Repositories\Field;

use App\Models\Field\CustomField;

class CustomFieldRepository
{
    public function all()
    {
        return CustomField::all();
    }

    public function create(array $data)
    {
        return CustomField::create($data);
    }

    public function find($id)
    {
        return CustomField::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $customField = CustomField::findOrFail($id);
        $customField->update($data);
        return $customField;
    }

    public function delete($id)
    {
        CustomField::destroy($id);
    }
}
