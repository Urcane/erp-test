<?php

namespace App\Services\Master;

use App\Repositories\Master\FileRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

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

    public static function fromBase64(string $base64File): UploadedFile
    {
        // Get file data base64 string
        $fileData = base64_decode(Arr::last(explode(',', $base64File)));

        // Create temp file and get its absolute path
        $tempFile = tmpfile();
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];

        // Save file data in file
        file_put_contents($tempFilePath, $fileData);

        $tempFileObject = new File($tempFilePath);
        $file = new UploadedFile(
            $tempFileObject->getPathname(),
            $tempFileObject->getFilename(),
            $tempFileObject->getMimeType(),
            0,
            true // Mark it as test, since the file isn't from real HTTP POST.
        );

        // Close this file after response is sent.
        // Closing the file will cause to remove it from temp director!
        app()->terminating(function () use ($tempFile) {
            fclose($tempFile);
        });

        // return UploadedFile object
        return $file;
    }
}