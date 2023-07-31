<?php

namespace App\Repositories\Master;

use App\Http\Requests\Opportunity\Survey\SoftSurveyRequest;
use App\Models\Master\File;
use App\Repositories\Sales\Opportunity\Survey\SoftSurveyRepository;

class FileRepository
{
    protected $model;

    public function __construct(File $model) {
        $this->model = $model;
    }

    function save($data, $referenceModel) {
        $result = $referenceModel->attachment()->save(new File([
            'name' => $data['fileName'],
            'additional' => $data['additional'] ?? NULL,
            'path' => $data['fullPath'],
            'user_id' => auth()->user()->id,
        ]));

        return $result;
    }
}