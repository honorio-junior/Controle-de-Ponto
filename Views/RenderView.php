<?php
namespace Views;
require_once dirname(__DIR__) . '/autoload.php';

class RenderView
{
    function __construct(string $view, array $data)
    {
        if(!empty($data)){
            extract($data);
        }
        require_once __DIR__ . '/' . $view . '.php';
    }
}
