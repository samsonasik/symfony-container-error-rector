<?php

namespace Symfony\Component\DependencyInjection\Tests\Compiler;

use Symfony\Contracts\Service\Attribute\Required;

class Foo
{
    public static int $counter = 0;
    public int $foo = 0;

    #[Required]
    public function cloneFoo(?\stdClass $bar = null): static
    {
        ++self::$counter;

        return clone $this;
    }
}
