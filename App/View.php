<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    public function __construct(private string $viewPath)
    {
        
    }

    public function render(): string
    {

        $viewPath = VIEWS_DIR_PATH . $this->viewPath . '.php';

        if(! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        ob_start();

        include $viewPath;

        return (string) ob_get_clean();
    }
}