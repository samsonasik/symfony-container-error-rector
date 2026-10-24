<?php

namespace Symfony\Component\DependencyInjection\Tests\Dumper;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\DependencyInjection\Attribute\AutowireCallable;
use Symfony\Component\DependencyInjection\Attribute\AutowireServiceClosure;

class LazyClosureConsumer
{
    public function __construct(
        #[AutowireServiceClosure('foo')]
        public \Closure $foo,
        #[Autowire(service: 'baz')]
        public \Closure $baz,
        #[AutowireCallable(service: 'foo', method: 'cloneFoo')]
        public \Closure $buz,
        #[AutowireCallable(service: 'my_callable')]
        public \Closure $bar,
        #[Autowire(env: 'FOO')]
        public string|\Closure|null $getFoo = null,
        #[Autowire(env: 'BAR')]
        public string|\Stringable $getBar = 'bar',
        #[Autowire('redis://%env(HOST)%:%env(PORT)%')]
        public ?\Stringable $getDsn = null,
        #[Autowire('%dsn_template%')]
        public ?\Stringable $getDsnFromParam = null,
    ) {
    }
}
