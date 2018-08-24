<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 22/08/2018
 * Time: 18:28
 */

namespace Kiron\MVC;

use Kiron\Http\Request;
use Kiron\Lang\Language;

abstract class View
{
    protected $cache;
    
    protected $lang;

    protected $document;

    public function __construct()
    {
        $this->lang = new Language(substr(Request::getLanguage(), 0, 2));
    }

}