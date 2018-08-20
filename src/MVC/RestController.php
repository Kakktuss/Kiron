<?php

namespace Kiron\Mvc;

use Kiron\Mvc\BaseController;
use Kiron\Http\Request;

abstract class RestController extends BaseController {

    /**
     * RestController constructor.
     * @param $type
     */
    public function __construct($type)
    {
        parent::__construct($type);
    }

    /**
     * @return mixed
     */
    abstract function index();

    /**
     * @param $vUrlName
     * @return mixed
     */
    abstract function show($vUrlName);

    /**
     * @return mixed
     */
    abstract function store();

    /**
     * @param $vUrlName
     * @return mixed
     */
    abstract function update($vUrlName);

    /**
     * @param $vUrlName
     * @return mixed
     */
    abstract function destroy($vUrlName);
}

?>