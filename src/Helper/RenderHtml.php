<?php

/**
 * @author Bruno Dadario <brunof19d@gmail.com>
 * @link https://github.com/brunof19d
 * @license MIT License
 */

namespace App\Helper;

trait RenderHtml
{
    /**
     * Renderizar o html.
     * @param string $template
     * @param array $info 	
     * @return string
     */
    public function render(string $template, array $info): string
    {
        extract($info);
        ob_start();
        require_once __DIR__ . '/../../view/templates/' . $template;
        return $html = ob_get_clean();
    }
}