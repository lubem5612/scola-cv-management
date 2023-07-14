<?php


namespace Transave\ScolaCvManagement\Helpers;


use Illuminate\Http\UploadedFile;
use function Symfony\Component\ErrorHandler\Exception\setTraceFromThrowable;

trait UploadHelper
{
    private $uploadedFileSize = 0;
    private $uploadedFilePath = '';
    private $uploadedFileExtension = '';
    private UploadedFile $uploadedFile;
    private $disks = [];
    private $isUploadSuccessful = false;
    private $uploadedFileError = [];
    private $uploadedFileMessage = '';

    public function fileUpload(UploadedFile $uploadedFile, $folder, $disk='azure')
    {
        try{
            $extension = $uploadedFile->getClientOriginalExtension();
            $filename = uniqid().'.'.$extension;

            $path = $uploadedFile->storePubliclyAs($folder, $filename, $disk);
            if ($path) {
                if (env('AZURE_STORAGE_PREFIX')) {
                    $data = config('scolacv.azure.storage_url').env('AZURE_STORAGE_PREFIX').'/'.$path;
                }else {
                    $data = config('scolacv.azure.storage_url').$path;
                }
                $this->uploadedFileSize = $uploadedFile->getSize();
                $this->uploadedFileExtension = $extension;
                $this->uploadedFilePath = $data;
                $this->isUploadSuccessful = true;
                $this->uploadedFileMessage = "upload successful";
            }
        }catch (\Exception $exception) {
            $this->uploadedFileMessage= $exception->getMessage();
            $this->uploadedFileError = $exception->getTrace();
        }
        return $this->response();
    }

    private function response()
    {
        return [
            "success"       => $this->isUploadSuccessful,
            "upload_url"    => $this->uploadedFilePath,
            "mime_type"     => $this->uploadedFileExtension,
            "size"          => $this->uploadedFileSize,
            "message"       => $this->uploadedFileMessage,
            "errors"        => $this->uploadedFileError,
        ];
    }
}