<?php

namespace app\engine;

use app\interfaces\IRender;

class TwigRender implements IRender
{
    private $loader;
    private $twig;

    public function __construct()
    {
        $this->loader = new \Twig\Loader\FilesystemLoader(ROOT.'/templates');

        $this->twig = new \Twig\Environment($this->loader, [
            'debug' => true,
        ]);

        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
    }

    public function renderTemplate($template, $params = [])
    {
        return $this->twig->render($template.'.twig', $params);
    }
}