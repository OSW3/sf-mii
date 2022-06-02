<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CopyrightExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('copyright', [$this, 'doCopyright']),
        ];
    }

    public function doCopyright(string $name): string
    {
        $date = date('Y');

        return "&copy; $date $name.";
    }
}
