<?php

namespace App\Http\Controllers\Management;

use App\Models\Profile;
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\AcademicTitle\AcademicTitleInterface;
use App\Repositories\RawProfile\RawProfileInterface;
use App\Http\Requests\UpdateRawProfile;

class RawProfileController extends RecordController
{
    protected $academicTitleRepository;
    protected $provinceRepository;

    public function __construct(
        RawProfileInterface $rawProfileRepository,
        ProvinceInterface $provinceRepository,
        AcademicTitleInterface $academicTitleRepository)
    {
        $this->academicTitleRepository = $academicTitleRepository;
        $this->provinceRepository = $provinceRepository;
        $this->recordRepository = $rawProfileRepository;
        $this->viewIndex = 'management.raw-profiles.index';
        $this->viewRecords = 'management.raw-profiles.records';
        $this->viewShow = 'management.raw-profiles.show';
        $this->viewRecord = 'management.raw-profiles.record';
        $this->viewEdit = 'management.raw-profiles.edit';
    }


    public function update(UpdateRawProfile $validUpdateRequest, $id)
    {
        return $this->updateRecord($validUpdateRequest, $id);
    }

    public function transfer($ids)
    {
        return $this->transferData($ids, ['avatar']);
    }

    public function transferToRecordModel($record)
    {
        $transferTo = assignObject($record, new Profile);
        $transferTo->province()->associate(
            $this->provinceRepository->findBy('normalize', strNormalize($record->province)) ??
            $this->provinceRepository->findBy('normalize', strNormalize('Khác'))
        );
        $transferTo->academicTitle()->associate(
            $this->academicTitleRepository->findBy('normalize', strNormalize($record->academic_title)) ??
            $this->academicTitleRepository->findBy('normalize', strNormalize('Khác'))
        );
        $transferTo->path = substr(strToPath($record->name), 0, 250);
        return $transferTo;
    }
}