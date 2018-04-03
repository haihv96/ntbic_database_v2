<?php

namespace App\Repositories\Product;

interface ProductInterface
{
    public function indexQuery($search);

    public function showQuery($id);

    public function updatedQuery($id);
}
