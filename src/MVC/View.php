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
    /**
     * @var
     */
    protected $cache;

    /**
     * @var Language
     */
    protected $lang;

    /**
     * @var
     */
    protected $document;

    /**
     * @var \ReflectionClass
     */
    protected $self;

    /**
     * @var
     */
    protected $defaultHtml;

    /**
     * View constructor.
     * @throws \ReflectionException
     */
    public function __construct()
    {
        $this->lang = new Language(substr(Request::getLanguage(), 0, 2));
        $this->self = new \ReflectionClass($this);
    }

    /**
     * @param string $name
     */
    public function setDefaultHtml(string $name)
    {
        $this->defaultHtml = $name ?? 'default';
    }

    /**
     * @param array $params
     */
    public function setupParams(array $params)
    {
        foreach ($params['params'] as $key => $value)
        {
            $this->params->$key = $value;
        }
        foreach ($params['models'] as $key => $value)
        {
            $this->models->$key = $value;
        }
    }

    /**
     * @param string $layout
     * @param string $tpl
     * @return bool
     */
    public function render(string $layout, string $tpl)
    {
        if(dirname($this->self->getFileName()).DS.'tmpl'.DS.$layout.'_'.$tpl.'.php')
        {
            ob_start();
            $this;
            include dirname($this->self->getFileName()).DS.'tmpl'.DS.$layout.'_'.$tpl.'.php';
            ob_end_clean();
            ob_start();
            if(file_exists(dirname(dirname($this->self->getFileName())).DS.DEFAULT_HTML_FILE.'.php'))
                include dirname(dirname($this->self->getFileName())).DS.DEFAULT_HTML_FILE.'.php';
            $content = ob_get_contents();
            ob_end_clean();
            echo $content;
            return true;
        }
        return false;
    }
}