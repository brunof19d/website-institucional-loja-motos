<?php

namespace App\View\Admin\Users;

use Nyholm\Psr7\Response;
use App\Helper\RenderHtml;
use App\Repository\UserRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class UsersPage implements RequestHandlerInterface
{
    use RenderHtml;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $arrayUsers = $this->repository->findAllUsers();

        $html = $this->render('admin/users/users.php', [
            'title' => 'Admin | Users',
            'arrayUsers' => $arrayUsers
        ]);
        return new Response(200, [], $html);
    }
}
