<?php

namespace app\Core;

class Template
{
    const TEMPLATE_DIR = __DIR__.'./../View/templates/';

    public function render(string $filename, array $data = null)
    {
        ob_start();
        if ($data !== null) {
            extract($data);
        }
        require_once self::TEMPLATE_DIR.$filename;
        echo ob_get_clean();
    }
}