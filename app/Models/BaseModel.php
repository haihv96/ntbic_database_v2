<?php

namespace App\Models;

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function baseEsIndexing($index, $type, $attrIndexing)
    {
        ClientBuilder::create()->build()->index([
            'index' => $index,
            'type' => $type,
            'id' => $this->id,
            'body' => array_filter($this->toArray(), function ($k) use ($attrIndexing) {
                return in_array($k, $attrIndexing);
            }, ARRAY_FILTER_USE_KEY)
        ]);
    }

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
