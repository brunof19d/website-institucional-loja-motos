<?php

/**
 * @author Bruno Dadario <brunof19d@gmail.com>
 * @link https://github.com/brunof19d
 * @license MIT License
 */

namespace App\Helper;

trait FlashMessageTrait
{
    public function defineMessage(string $class, string $message): void
    {
        $_SESSION['message'] = $message;
        $_SESSION['class_bootstrap'] = $class;
    }
}