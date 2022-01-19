<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    public function __construct(
        private string $templatePath, 
        private string $viewPath, 
        private array $params
        )
    {
        
    }

    public function render(): string
    {
        $templatePath = VIEWS_DIR_PATH . $this->templatePath . '.php';
        $viewPath = VIEWS_DIR_PATH . $this->viewPath . '.php';

        if(! file_exists($viewPath) || ! file_exists($templatePath)) {
            throw new ViewNotFoundException();
        }

        ob_start();

        include $viewPath;

        $viewString = (string) ob_get_clean();

        ob_start();

        include $templatePath;

        return (string) ob_get_clean();
    }
}