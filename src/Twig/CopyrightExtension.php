<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class CopyrightExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'copyright', 
                [$this, 'doCopyright'], 
                ['is_safe' => ['html']]
            ),
        ];
    }

    public function doCopyright(string $name, ?int $since = null): string
    {
        $date = date('Y');

        $str = "&copy; ";
        $str.= ($since && $since < $date) ? $since. " - " : null;
        $str.= "$date $name.";

        return $str;
    }
}