<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getProvincesAttribute()
    {
        return Province::select('id', 'name')->get()->mapWithKeys(function ($entry) {
            return [$entry->id => $entry->name];
        })->sortBy(function ($value, $key) {
            return $key;
        })->all();
    }

    public function getBaseTechnologyCategoriesAttribute()
    {
        return BaseTechnologyCategory::select('id', 'name')->get()->mapWithKeys(function ($entry) {
            return [$entry->id => $entry->name];
        })->sortBy(function ($value, $key) {
            return $key;
        })->all();
    }

    public function getSpecializationsAttribute()
    {
        return Specialization::select('id', 'name')->get()->mapWithKeys(function ($entry) {
            return [$entry->id => $entry->name];
        })->sortBy(function ($value, $key) {
            return $key;
        })->all();
    }

    public function getPatentTypesAttribute()
    {
        return PatentType::select('id', 'name')->get()->mapWithKeys(function ($entry) {
            return [$entry->id => $entry->name];
        })->sortBy(function ($value, $key) {
            return $key;
        })->all();
    }
}
