<?php

namespace App\Repositories\Profile;

use App\Repositories\BaseRepository;
use App\Models\Profile;

class ProfileRepository extends BaseRepository implements ProfileInterface
{
    public function __construct(Profile $profile)
    {
        parent::__construct($profile);
    }

    public function indexQuery($search)
    {
        return $this->model
            ->join('academic_titles', 'academic_titles.id', '=', 'profiles.academic_title_id')
            ->select(
                'profiles.*',
                'academic_titles.name as academic_title'
            )
            ->where('profiles.name', 'like', "%$search%");
    }

    public function showQuery($id)
    {
        return $this->model
            ->join('academic_titles', 'academic_titles.id', '=', 'profiles.academic_title_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.province_id')
            ->where('profiles.id', $id)
            ->select(
                'profiles.*',
                'academic_titles.name as academic_title',
                'provinces.name as province'
            )
            ->first();
    }

    public function updatedQuery($id)
    {
        return $this->model
            ->join('academic_titles', 'academic_titles.id', '=', 'profiles.academic_title_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.province_id')
            ->where('profiles.id', $id)
            ->select(
                'profiles.*',
                'academic_titles.name as academic_title'
            )
            ->first();
    }
}