<?php

namespace App\Controller\Admin\Users;

use Exception;
use App\Entity\User;
use Nyholm\Psr7\Response;
use App\Helper\FlashMessageTrait;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateUser implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(User $user, UserRepository $repository)
    {
        $this->user = $user;
        $this->repository = $repository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $dadosInput = $request->getParsedBody();

            $userName = filter_var($dadosInput['username'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            if ($userName === FALSE) {
                throw new Exception("Nome de usuário inválido");
            } elseif (strlen($userName) > 50) {
                throw new Exception("Nome do usuário não pode conter mais que 50 letras.");
            }

            if ($dadosInput['password'] !== $dadosInput['confirm_password']) {
                throw new Exception('A confirmação da senha não foi igual a digitada.');
            }

            $password = filter_var($dadosInput['password'], FILTER_SANITIZE_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
            if ($password === FALSE) {
                throw new Exception("Senha inválida");
            }
            $password = password_hash($password, PASSWORD_DEFAULT);

            $this->user->setNameUser($userName)->setPasswordUser($password);

            $this->repository->createUser($this->user);

            $this->defineMessage('success', 'Usuário cadastrado com sucesso');
            return new Response(200, ['Location' => '/admin/users']);
        } catch (Exception $error) {
            $this->defineMessage('danger', $error->getMessage());
            return new Response(302, ['Location' => '/admin/users']);
        }
    }
}
