<?php

namespace Controllers;

require_once dirname(__DIR__) . '/autoload.php';

use Models\UserModel;
use Views\RenderView;


class HomeController extends BaseController
{
    function getTime()
    {
        echo json_encode(['hora' => date('d/m/Y H:i:s')]);
    }

    function get_user_by_client_ip()
    {
        $db = new UserModel;
        $userName = $db->getByIP($this->get_client_ip());
        return $userName;
    }

    function index()
    {
        return new RenderView('index', [
            "ip" => $this->get_client_ip(),
            'erro' => $_GET['erro'] ?? '',
            'success' => $_GET['success'] ?? '',
            "userName" => $this->get_user_by_client_ip()['name']]
        );
    }
}
