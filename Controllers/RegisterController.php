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
        if ($user == false) {
            return header('Location: /?erro=Registration+Not+Found');
        }

        //tem ip registrado no user e os ips sao iguais: registra 
        if (!empty($registeredIP) && $registeredIP == $ipRegistering) {
            $this->saveRecord($this->makeRecord($user));
            return header('Location: /?success=Registered');
        }

        //tem ip registrado no user e os ips sao diferentes: erro
        if (!empty($registeredIP) && $registeredIP != $ipRegistering) {
            return header('Location: /?erro=Registration+used+on+another+device');
        }

        $ipExistsInDb = $db->checkIPDeviceExists($ipRegistering);

        //nao tem ip registrado e o novo ip nao existe no db: registra
        if (empty($registeredIP) && !$ipExistsInDb) {
            $db->saveNewIp($registration, $ipRegistering);
            $this->saveRecord($this->makeRecord($user));
            return header('Location: /?success=Registered+point+and+new+device+registered');
        }

        //nao tem ip registrado e o novo ip existe no db: erro
        if (empty($registeredIP) && $ipExistsInDb) {
            return header('Location: /?erro=Device+used+on+another+registration');
        }
    }

}
