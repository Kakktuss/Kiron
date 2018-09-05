<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 24/06/2018
 * Time: 18:26
 */

namespace Kiron\Cache;

use Kiron\Config\Config;

class Cache
{

	private $cachePath;

	public function __construct()
	{
		$this->cachePath = $_SERVER['DOCUMENT_ROOT'].DS.ROOT.APPLICATION_PATH.DS.CACHE_PATH.DS;
	}

	public function add($fileName, $content)
	{
		file_put_contents($this->cachePath.$fileName.'.html', $content);
	}

	public function delete($fileName)
	{
		unlink($this->cachePath.$fileName.'.html');
	}

	public function isExpired($fileName)
	{
        return file_exists($this->cachePath.$fileName.'.html') && filemtime($this->cachePath.$fileName.'.html') > (time() - intval(Config::getInstance()->getCacheExpirationTime()));
    }

	public function get($fileName)
	{
		echo readfile($this->cachePath.$fileName.'.html');
	}

}