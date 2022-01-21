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

        $params = $this->params;

        $stylesheetsString = '';
        if($params['stylesheets']) {
            $stylesheetsString = $this->generateStylesheetsString($params['stylesheets']);
        }

        echo $stylesheetsString;

        ob_start();

        include $viewPath;

        $viewString = (string) ob_get_clean();

        ob_start();

        include $templatePath;

        return (string) ob_get_clean();
    }

    private function generateStylesheetsString(): string
    {
        $stylesheetsString = '';
        foreach($this->params['stylesheets'] as $link) {
            
            // if link is to local file
            $dir = 'Views/';
            if(strpos($link, 'http') !== false) {
                $dir = '';
            }

            $stylesheetsString .= '<link href="' . $dir .  $link . '" rel="stylesheet">';
        }
        return $stylesheetsString;
    }
}