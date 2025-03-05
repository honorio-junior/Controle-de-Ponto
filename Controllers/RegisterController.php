<?php

namespace Controllers;

require_once dirname(__DIR__) . '/autoload.php';

use Models\UserModel;

class RegisterController extends BaseController
{
    function saveRecord($point)
    {
        $arquivo = 'dados.csv';

        // Abre o arquivo em modo de escrita
        if (($handle = fopen($arquivo, 'a')) !== false) {
            // Escreve o registro no arquivo
            fputcsv($handle, $point);

            // Fecha o arquivo
            fclose($handle);

            echo "Dados escritos com sucesso!";
        } else {
            echo "Não foi possível abrir o arquivo para escrita.";
        }
    }

    function makeRecord($user)
    {
        return [$user['registration'], $user['name'], date('d/m/Y H:i:s')];
    }

    function register()
    {
        $registration = $_POST['registration'];
        $ipRegistering = $this->get_client_ip();

        $db = new UserModel;
        $user = $db->getByRegistration($registration);
        $registeredIP = $user['ipDevice'];

        // Verifica se existe matricula registrada
        if ($user == null) {
            return header('Location: /?erro=Registration+Not+Found');
        }

        // Verifica se o ip registrado no usuario nao e vazio e igual ao ip que esta registrando
        if (!empty($registeredIP) && $registeredIP == $ipRegistering) {
            $this->saveRecord($this->makeRecord($user));
            return header('Location: /?success=Registered');
        }

        // Verifica se o ip registrado no usuario nao e vazio e diferente do ip que esta registrando
        if (!empty($registeredIP) && $registeredIP != $ipRegistering) {
            return header('Location: /?erro=Registration+used+on+another+device');
        }

        // Verifica se o ip que registrou existe no db
        if ($db->checkIPDeviceExists($ipRegistering)) {
            return header('Location: /?erro=Device+used+on+another+registration');
        }

        // Verifica se o ip que registrou nao existe no db
        if (!$db->checkIPDeviceExists($ipRegistering)) {
            $db->saveNewIp($registration, $this->get_client_ip());
            $this->saveRecord($this->makeRecord($user));
            return header('Location: /?success=Registered+point+and+new+device+registered');
        }
    }
}
