<?php

namespace App\Views;

use Exception;

class View
{
    public function generateView($view, $data)
    {
        $content = $this->generateFile($view, [
            'data' => $data,
        ]);

        return $view = $this->generateFile('layout', [
            'content' => $content,
        ]);
    }

    private function generateFile($view, $data)
    {
        $viewFile = '../app/views/' . $view . '.php';

        if (file_exists($viewFile)) {
            extract($data);

            ob_start();

            require_once($viewFile);

            return $content = ob_get_clean();
        } else {
            throw new Exception("View: Fichier vue ($viewFile) inexistant, page introuvable");
        }
    }
}
