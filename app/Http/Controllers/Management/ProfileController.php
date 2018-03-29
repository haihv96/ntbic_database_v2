<?php

namespace App\Http\Controllers\Management;

use App\Repositories\Profile\ProfileInterface;
use App\Http\Requests\UpdateProfile;
use Closure;

class ProfileController extends RecordController
{
    public function __construct(ProfileInterface $profileRepository)
    {
        $this->recordRepository = $profileRepository;
        $this->viewIndex = 'management.profiles.index';
        $this->viewRecords = 'management.profiles.records';
        $this->viewShow = 'management.profiles.show';
        $this->viewRecord = 'management.profiles.record';
        $this->viewEdit = 'management.profiles.edit';
    }

    public function customIndexQuery($search)
    {
        return $this->recordRepository
            ->join('academic_titles', 'academic_titles.id', '=', 'profiles.academic_title_id')
            ->select(
                'profiles.*',
                'academic_titles.name as academic_title'
            )
            ->where('profiles.name', 'like', "%$search%");
    }

    public function customShowQuery($id)
    {
        return $this->recordRepository
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

    public function customUpdatedQuery($id)
    {
        return $this->recordRepository
            ->join('academic_titles', 'academic_titles.id', '=', 'profiles.academic_title_id')
            ->join('provinces', 'provinces.id', '=', 'profiles.province_id')
            ->where('profiles.id', $id)
            ->select(
                'profiles.*',
                'academic_titles.name as academic_title'
            )
            ->first();
    }

    public function update(UpdateProfile $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id, function($record){
            $record->esUpdate();
        });
    }

    public function destroy($ids, Closure $callback = null)
    {
        return parent::destroy($ids, function($record){
            $record->esDelete();
        });
    }
}
