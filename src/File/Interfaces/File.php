<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/09/2018
 * Time: 15:52
 */

namespace Kiron\File\Interfaces;

interface File
{

    public function createFile();

    public function resetFileContent();

    public function deleteFile();

}