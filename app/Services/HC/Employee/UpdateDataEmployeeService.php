<?php

namespace App\Services\HC\Employee;

use App\Repositories\HC\Employee\EmployeeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class FileService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository) {
        $this->employeeRepository = $employeeRepository;
    }

    function Update(Model $model, $data) {


        return $result;
    }
}
