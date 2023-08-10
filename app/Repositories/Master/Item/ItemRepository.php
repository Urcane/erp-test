<?php

namespace App\Repositories\Master\Item;

use App\Models\Opportunity\BoQ\Items;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ItemRepository.
 */
class ItemRepository
{
    /**
     * @return string
     *  Return the model
     */
    protected $model;

    public function model(Items $model)
    {
        $this->model = $model;
    }
}
