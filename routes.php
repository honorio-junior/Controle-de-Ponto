<?php

return [
    ['/' => 'HomeController@index?GET'],
    ['/getTime' => 'HomeController@getTime?GET'],
    ['/register' => 'RegisterController@register?POST'],
];

exit();
