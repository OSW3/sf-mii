<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

class UtilsExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('json_decode', [$this, 'doJsonDecode']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('json_decode', [$this, 'doJsonDecode']),
            new TwigFunction('isString', [$this, 'doIsString']),
        ];
    }

    public function getTests()
    {
        return [
            new TwigTest('isString', [$this, 'doIsString']),
        ];
    }

    public function doJsonDecode($data): array
    {
        return json_decode($data, true);
    }

    public function doIsString($data): bool
    {
        return is_string($data);
    }
}
