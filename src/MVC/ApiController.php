<?php

namespace Kiron\Mvc;

use Kiron\Http\Header\Seter;
use Kiron\MVC\Interfaces\Controller as ControllerInterface;
use Kiron\MVC\Interfaces\ApiController as ApiControllerInterface;

abstract class ApiController extends Controller implements ApiControllerInterface {

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