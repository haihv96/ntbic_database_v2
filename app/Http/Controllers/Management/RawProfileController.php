<?php

namespace App\Http\Controllers\Management;

use App\Models\Profile;
use App\Repositories\Profile\ProfileInterface;
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\AcademicTitle\AcademicTitleInterface;
use App\Repositories\RawProfile\RawProfileInterface;
use App\Http\Requests\UpdateRawProfile;

class RawProfileController extends RecordController
{
    protected $profileRepository;
    protected $academicTitleRepository;
    protected $provinceRepository;

    public function __construct(
        RawProfileInterface $rawProfileRepository,
        ProfileInterface $profileRepository,
        ProvinceInterface $provinceRepository,
        AcademicTitleInterface $academicTitleRepository)
    {
        $this->profileRepository = $profileRepository;
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
        return $this->transferRecord($ids, new Profile);
    }

    public function transferToRecordModel($record, $transferTo)
    {
        $transferTo = assignObject([
            'url',
            'studies_or_papers',
            'name',
            'birthday',
            'specialization',
            'agency',
            'agency_address',
            'research_for',
            'research_joined',
            'research_results'
        ], $record, $transferTo);

        $transferTo->province()->associate(
            $this->provinceRepository->findBy('normalize', strNormalize($record->province)) ??
            $this->provinceRepository->findBy('normalize', strNormalize('Khác'))
        );

        $transferTo->academicTitle()->associate(
            $this->academicTitleRepository->findBy('normalize', strNormalize($record->academic_title)) ??
            $this->academicTitleRepository->findBy('normalize', strNormalize('Khác'))
        );

        $transferTo->path = strToPath($record->name);

        return $transferTo;
    }
}