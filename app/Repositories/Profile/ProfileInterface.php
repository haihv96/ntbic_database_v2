<?php

namespace App\Repositories\Profile;

interface ProfileInterface
{
    public function indexQuery($search);

    public function showQuery($id);

    public function updatedQuery($id);
}
