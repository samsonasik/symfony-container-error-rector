<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\DependencyInjection\Exception\ParameterNotFoundException;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;
use Symfony\Component\DependencyInjection\ParameterBag\FrozenParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Symfony_DI_PhpDumper_Test_Autowire_Closure extends Container
{
    /**
     * Gets the public 'bar' shared autowired service.
     *
     * @return \Symfony\Component\DependencyInjection\Tests\Dumper\LazyClosureConsumer
     */
    protected static function getBarService($container)
    {
        return $container->services['bar'] = new \Symfony\Component\DependencyInjection\Tests\Dumper\LazyClosureConsumer(#[\Closure(name: 'foo', class: 'Symfony\\Component\\DependencyInjection\\Tests\\Compiler\\Foo')] fn () => ($container->services['foo'] ??= new \Symfony\Component\DependencyInjection\Tests\Compiler\Foo()), ($container->services['baz'] ?? self::getBazService($container)), (new class(fn () => ($container->services['foo'] ??= new \Symfony\Component\DependencyInjection\Tests\Compiler\Foo())) extends \Symfony\Component\DependencyInjection\Argument\LazyClosure { public function cloneFoo(?\stdClass $bar = null): \Symfony\Component\DependencyInjection\Tests\Compiler\Foo { return $this->service->cloneFoo(...\func_get_args()); } })->cloneFoo(...), (new class(fn () => ($container->services['my_callable'] ??= new \Symfony\Component\DependencyInjection\Tests\Compiler\MyCallable())) extends \Symfony\Component\DependencyInjection\Argument\LazyClosure { public function __invoke(): void { $this->service->__invoke(...\func_get_args()); } })->__invoke(...), fn () => $container->getEnv('default::FOO'), new \Symfony\Component\DependencyInjection\Argument\EnvClosure(fn () => $container->getEnv('BAR'), 'bar'), new \Symfony\Component\DependencyInjection\Argument\EnvClosure(fn () => 'redis://'.$container->getEnv('string:HOST').':'.$container->getEnv('string:PORT'), NULL), new \Symfony\Component\DependencyInjection\Argument\EnvClosure(fn () => 'redis://'.$container->getEnv('string:HOST').':'.$container->getEnv('string:PORT'), NULL));
    }

    /**
     * Gets the public 'baz' shared service.
     *
     * @return \Closure
     */
    protected static function getBazService($container)
    {
        return $container->services['baz'] = \var_dump(...);
    }

    /**
     * Gets the public 'foo' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\Tests\Compiler\Foo
     */
    protected static function getFooService($container)
    {
        return $container->services['foo'] = new \Symfony\Component\DependencyInjection\Tests\Compiler\Foo();
    }

    protected static function getMyCallableService($container)
    {
        return $container->services['my_callable'] = new \Symfony\Component\DependencyInjection\Tests\Compiler\MyCallable();
    }

    public function getParameter(string $name): array|bool|string|int|float|\UnitEnum|null
    {
        if (isset($this->loadedDynamicParameters[$name])) {
            $value = $this->loadedDynamicParameters[$name] ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
        } elseif (\array_key_exists($name, $this->parameters) && '.' !== ($name[0] ?? '')) {
            $value = $this->parameters[$name];
        } else {
            throw new ParameterNotFoundException($name);
        }

        return $value;
    }

    public function hasParameter(string $name): bool
    {
        return \array_key_exists($name, $this->parameters) || isset($this->loadedDynamicParameters[$name]);
    }
    public function getParameterBag(): ParameterBagInterface
    {
        if (!isset($this->parameterBag)) {
            $parameters = $this->parameters;
            foreach ($this->loadedDynamicParameters as $name => $loaded) {
                $parameters[$name] = $loaded ? $this->dynamicParameters[$name] : $this->getDynamicParameter($name);
            }
            $this->parameterBag = new FrozenParameterBag($parameters, []);
        }

        return $this->parameterBag;
    }

    private $loadedDynamicParameters = [
        'dsn_template' => false,
    ];
    private $dynamicParameters = [];

    private function getDynamicParameter(string $name)
    {
        $container = $this;
        $value = match ($name) {
            'dsn_template' => 'redis://'.$container->getEnv('string:HOST').':'.$container->getEnv('string:PORT'),
            default => throw new ParameterNotFoundException($name),
        };
        $this->loadedDynamicParameters[$name] = true;

        return $this->dynamicParameters[$name] = $value;
    }

}
