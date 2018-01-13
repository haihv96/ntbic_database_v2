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
}