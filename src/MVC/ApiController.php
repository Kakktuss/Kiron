<?php

namespace Kiron\Mvc;

use Kiron\Http\Header;

abstract class ApiController extends Controller {

    public function setRendering(string $rendering)
    {
        switch ($rendering)
        {
            case 'json':
                Header::setContentType('application/json');
                break;
            case 'text':
                case 'html':
                    Header::setContentType('text/html');
                    break;
            default:
                Header::setContentType('application/json');
        }
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