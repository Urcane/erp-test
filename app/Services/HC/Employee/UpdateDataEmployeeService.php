<?php

namespace App\Services\HC\Employee;

use App\Repositories\HC\Employee\EmployeeRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class FileService
{
    protected $fileRepository;

    public function __construct(FileRepository $fileRepository) {
        $this->fileRepository = $fileRepository;
    }

    function storeFile(Model $model, $data) {
        if (!($data['file'] instanceof UploadedFile)) {
            throw new \Exception("Uploaded File not valid", 403);
        }

        $path = $data['file']->store($data['filePath']);

        $data['fullPath'] = $path;

        $result = $this->fileRepository->save($data, $model);

        return $result;
    }
}
