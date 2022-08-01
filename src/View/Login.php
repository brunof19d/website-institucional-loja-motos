<?php

namespace App\View;

/**
 * @author Bruno Dadario <brunof19d@gmail.com>
 * @link https://github.com/brunof19d
 * @license MIT License
 */

use App\Helper\Helper;
use Nyholm\Psr7\Response;
use App\Helper\RenderHtml;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Login implements RequestHandlerInterface
{
    use RenderHtml;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $tokenCsrf = $this->helper->csrfToken();

        $html = $this->render('login.php', [
            'title' => 'Login',
            'tokenCsrf' => $tokenCsrf
        ]);
        return new Response(200, [], $html);
    }
}
