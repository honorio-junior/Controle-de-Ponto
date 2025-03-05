<?php

namespace Models;

class UserModel extends BaseModel
{
    function getByIP($ip)
    {
        $stmt = $this->prepare('SELECT * FROM user WHERE ipDevice = :ip LIMIT 1');

        $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);

        $result = $stmt->execute();

        $data = $result->fetchArray(SQLITE3_ASSOC);

        if ($data == false) {
            return ['name' => 'Not registered'];
        }

        return $data;
    }

    function getByRegistration($registration)
    {
        $stmt = $this->prepare('SELECT * FROM user WHERE registration = :registration LIMIT 1');

        $stmt->bindValue(':registration', $registration, SQLITE3_TEXT);

        $result = $stmt->execute();

        $data = $result->fetchArray(SQLITE3_ASSOC);

        return $data;
    }

    function saveNewIp($registration, $ip)
    {
        // Preparar a query para atualizar o ipDevice para o usuário específico
        $stmt = $this->prepare('UPDATE user SET ipDevice = :ip WHERE registration = :registration');

        // Vincular os valores para a query
        $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);
        $stmt->bindValue(':registration', $registration, SQLITE3_TEXT);

        // Executar a query
        $result = $stmt->execute();

        // Verificar se a atualização foi bem-sucedida
        if ($result) {
            // Retornar sucesso, ou algum dado que indique que a operação foi realizada
            return true;
        } else {
            // Retornar erro, caso algo tenha dado errado
            return false;
        }
    }

    function checkIPDeviceExists($ip)
    {
        // Preparar a query para verificar se o ipDevice informado já existe
        $stmt = $this->prepare('SELECT * FROM user WHERE ipDevice = :ip LIMIT 1');

        // Vincular o valor do IP para a query
        $stmt->bindValue(':ip', $ip, SQLITE3_TEXT);

        // Executar a query
        $result = $stmt->execute();

        // Verificar se o IP existe na tabela
        $data = $result->fetchArray(SQLITE3_ASSOC);

        if ($data) {
            // Se o IP for encontrado
            return true;
        } else {
            // Se o IP não for encontrado
            return false;
        }
    }

}
