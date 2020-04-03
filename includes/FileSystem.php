<?php
/**
 * Created by PhpStorm.
 * User: nkpc1
 * Date: 3/24/2020
 * Time: 12:23 PM
 */

class FileSystem
{
    private $targetDir;
    private $fileName;
    private $fileSize;
    private $fileTemp;
    private $fileType;
    private $targetFile;
    private $fileExt;
    private $extensions = array();
    private $MAX_SIZE;
    private $errors = array();

    public function __construct($targetDir, $size, $extensions = array())
    {
        $this->targetDir = $targetDir . "/";
        $this->MAX_SIZE = $size;
        $this->extensions = $extensions;
    }

    private function file($fieldName)
    {
        $this->fileName = $_FILES[$fieldName]["name"];
        $this->fileSize = $_FILES[$fieldName]["size"];
        $this->fileTemp = $_FILES[$fieldName]["tmp_name"];
        $this->fileType = $_FILES[$fieldName]["type"];
        $ext = explode('.', $this->fileName);
        $this->fileExt = strtolower(end($ext));
        $this->targetFile = $this->targetDir . basename($this->fileName);
    }

    public function upload($fileName, $postSignalName)
    {
        $this->file($fileName);
        if (isset($_POST[$postSignalName])) {
            $this->isAllowed();
            if (empty($this->errors)) {
                move_uploaded_file($this->fileTemp, $this->targetDir . $this->fileName);
                return $this->fileName;
            } else {
                print_r(print_r($this->errors));
            }
        }
    }


    private function isAllowed()
    {
        if (array_search($this->fileExt, $this->extensions) === false) {
            array_push($this->errors, "Uploaded file is not supported. Allowed File types are " . implode(", ", $this->extensions));
            return false;
        }
        if ($this->fileSize > $this->MAX_SIZE) {
            array_push($this->errors, "File size can't be more than " . $this->MAX_SIZE);
            return false;
        }
        return true;
    }
}