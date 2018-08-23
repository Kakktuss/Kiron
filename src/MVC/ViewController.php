<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 21/08/2018
 * Time: 09:55
 */

namespace Kiron\MVC;


use Kiron\Cache\Cache;
use Kiron\Emitter\Emitter;
use Kiron\Emitter\Listener;
use Kiron\Language\Lang;

abstract class ViewController extends Controller
{

    protected $lang;

    protected $emitter;

    protected $document;

    protected $cache;

    private $defaultLang = 'en';

    private $params;

    public function __construct()
    {
        parent::__construct();
        $this->lang = new Lang($this->defaultLang);
        $this->cache = new Cache('');
        $this->emitter = new Emitter();
    }

    public function setLang(string $lang = null)
    {
        $this->lang->setLang($lang ?? $this->defaultLang);
    }

    public function emitEvent(string $eventName, ...$args)
    {
        $this->emitter->emit($eventName, $args);
    }

    public function appendNormalListener(string $eventName, Listener $listener, int $priority)
    {
        $this->emitter->on($eventName, $listener, $priority);
    }

    public function appendOnceListener(string $eventName, Listener $listener, int $priority)
    {
        $this->emitter->once($eventName, $listener, $priority);
    }

    public function addParam($paramName, $value)
    {
        if(!$this->paramExists($paramName))
            $this->params[$paramName] = $value;
    }

    public function deleteParam($paramName)
    {
        if($this->paramExists($paramName))
            unset($this->params[$paramName]);
    }

    public function render()
    {
        ob_start();
        foreach ($this->params as $param => $value)
        {
            $this->$param = $value;
        }
        $this->document;
        require_once '';
        ob_end_clean();
        ob_start();
        require_once '';
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }

    private function paramExists($paramName)
    {
        return isset($this->params[$paramName]);
    }

}