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
