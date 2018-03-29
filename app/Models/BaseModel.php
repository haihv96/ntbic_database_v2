<?php

namespace App\Models;

use Elasticsearch\ClientBuilder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    public function collectEsAttrs()
    {
        return array_filter($this->toArray(), function ($k) {
            return in_array($k, $this->esAttributes);
        }, ARRAY_FILTER_USE_KEY);
    }

    public function esIndexing()
    {
        ClientBuilder::create()->build()->index([
            'index' => $this->esIndexName,
            'type' => $this->esTypeName,
            'id' => $this->id,
            'body' => $this->collectEsAttrs()
        ]);
    }

    public function esUpdate()
    {
        ClientBuilder::create()->build()->update([
            'index' => $this->esIndexName,
            'type' => $this->esTypeName,
            'id' => $this->id,
            'body' => [
                'doc' => $this->collectEsAttrs()
            ]
        ]);
    }

    public function esDelete()
    {
        ClientBuilder::create()->build()->delete([
            'index' => $this->esIndexName,
            'type' => $this->esTypeName,
            'id' => $this->id,
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
