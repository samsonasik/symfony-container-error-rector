<?php

namespace Symfony\Component\DependencyInjection\Tests\Compiler;

class MyCallable
{
    public function __invoke(): void
    {
    }

    public static function theMethodImpl(): int
    {
        return 124;
    }
}
