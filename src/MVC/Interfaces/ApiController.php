<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 15/09/2018
 * Time: 21:15
 */

namespace Kiron\MVC\Interfaces;


interface ApiController
{

    public function index();

    public function show($vUrlName);

    public function store();

    public function update($vUrlName);

    public function destroy($vUrlName);

}