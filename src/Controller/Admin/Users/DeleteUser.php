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

class DeleteUser implements RequestHandlerInterface
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
            $idUser = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT, [
                "options" => ["min_range" => 1]
            ]);

            if ($idUser === FALSE) {
                throw new Exception("ID do usuário inválido");
            } 

            $this->user->setIdUser($idUser);

            $this->repository->deleteUser($this->user);

            $this->defineMessage('warning', 'Usuário deletado com sucesso');
            return new Response(200, ['Location' => '/admin/users']);
        } catch (Exception $error) {
            $this->defineMessage('danger', $error->getMessage());
            return new Response(302, ['Location' => '/admin/users']);
        }
    }
}
