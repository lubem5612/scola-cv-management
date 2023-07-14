<?php


namespace Transave\ScolaCvManagement\Helpers;


trait UploadHelper
{
    private $uploadedFileSize = 0;
    private $uploadedFilePath = '';
    private $uploadedFileExtension = '';
    private UploadedFile $uploadedFile;
    private $disks = [];

    public function __construct()
    {
        $this->disks = ['azure', 's3', 'local'];
    }
}