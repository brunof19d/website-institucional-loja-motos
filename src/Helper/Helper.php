<?php

/**
 * @author Bruno Dadario <brunof19d@gmail.com>
 * @link https://github.com/brunof19d
 * @license MIT License
 */

namespace App\Helper;

class Helper
{
    /**
     * Gera um token para usar como CSRF.
     * @return string
     */
    public function csrfToken(): string
    {
        $_SESSION['csrf_token'] = sha1(rand(1, 50));
        return $_SESSION['csrf_token'];
    }

    /**
     * Verifica se a sessão do token csrf existe e se a sessão é igual aos dados recebidos pelo formulário.
     * @param string $token
     * @return bool
     */
    public function checkCsrfToken(string $token): bool
    {
        if (empty($_SESSION['csrf_token']) === FALSE) {
            if ($_SESSION['csrf_token'] === $token) {
                return true;
            }
            return false;
        }
        return false;
    }
}
