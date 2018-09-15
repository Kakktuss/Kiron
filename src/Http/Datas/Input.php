<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 20/08/2018
 * Time: 21:32
 */

namespace Kiron\Http\Datas;

use Kiron\Http\Interfaces\Input as InputInterface;

class Input implements InputInterface
{

    /**
     * @param string $inputName
     * @param string|int $value
     */
    public static function addInput(string $inputName, $value)
    {
        self::addGetInput($inputName, $value);
        Header::setLocation(Request::getUri().self::generateInputUri());
    }

    /**
     * @param string $inputName
     */
    public static function deleteInput(string $inputName)
    {
        self::deleteGetInput($inputName);
        Header::setLocation(Request::getUri().self::generateInputUri());
    }

    /**
     * @param string $inputName
     * @param $value
     */
    public static function alterInput(string $inputName, $value)
    {
        self::alterGetInput($inputName, $value);
        Header::setLocation(Request::getUri().self::generateInputUri());
    }

    /**
     * @param string $inputName
     * @return mixed
     */
    public static function getInput(string $inputName)
    {
        if(self::inputExists($inputName))
        {
            return $_GET[$inputName];
        }
    }

    /**
     * @return mixed
     */
    public static function getInputs()
    {
        return $_GET;
    }

    /**
     * @param string $inputName
     * @param $value
     */
    private static function alterGetInput(string $inputName, $value)
    {
        if(self::inputExists($inputName))
        {
            $_GET[$inputName] = $value;
        }
    }

    /**
     * @param string $inputName
     * @return bool
     */
    private static function inputExists(string $inputName)
    {
        return isset($_GET[$inputName]);
    }

    /**
     * @param string $inputName
     * @param $value
     */
    private static function addGetInput(string $inputName, $value)
    {
        if(!self::inputExists($inputName))
            $_GET[$inputName] = $value;
    }

    /**
     * @param string $inputName
     */
    private static function deleteGetInput(string $inputName)
    {
        if(self::inputExists($inputName))
            unset($_GET[$inputName]);
    }

    /**
     *
     */
    private static function generateInputUri()
    {
        $uri = '?';
        foreach (self::getInputs() as $key => $value)
        {
            $uri .= $key.'='.$value.'?';
        }
        return $uri;
    }

}