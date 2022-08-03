<?php

namespace App\View;

use App\Helper\Helper;
use Nyholm\Psr7\Response;
use App\Helper\RenderHtml;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Home implements RequestHandlerInterface
{
    use RenderHtml;

    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->render('home.php', [
            'title' => 'Home',
        ]);
        return new Response(200, [], $html);
    }
}
