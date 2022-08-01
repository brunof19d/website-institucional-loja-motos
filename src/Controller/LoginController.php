<?php

namespace App\Controller;

use Exception;
use App\Entity\User;
use App\Helper\Helper;
use Nyholm\Psr7\Response;
use App\Helper\FlashMessageTrait;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController
{
    use FlashMessageTrait;

    public function __construct(User $user, UserRepository $repository, Helper $helper)
    {
        $this->user = $user;
        $this->repository = $repository;
        $this->helper = $helper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $dadosForm = $request->getParsedBody();

            $token = $this->helper->checkCsrfToken($dadosForm['csrf_token']);
            if ($token === FALSE) {
                throw new Exception('CSRF Token inválido.');
            }

            $username = filter_var($dadosForm['username'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            if ($username === FALSE) {
                throw new Exception('Username inválido.');
            }

            $password = filter_var($dadosForm['password'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            if ($password === FALSE) {
                throw new Exception('Password não é valida.');
            }

            unset($_SESSION['csrf_token']);

            $this->user
                ->setNameUser($username)
                ->setPasswordUser($password);

            $login = $this->repository->findOneUserForLogin($this->user);

            if ($login === FALSE) {
                throw new Exception('E-mail ou senha incorreta.');
            }

            $_SESSION['auth'] = sha1(rand(1, 200));

            return new Response(200, ['Location' => '/home']);
        } catch (Exception $error) {
            $this->defineMessage('danger', $error->getMessage());
            return new Response(302, ['Location' => '/login']);
        }
    }
}
