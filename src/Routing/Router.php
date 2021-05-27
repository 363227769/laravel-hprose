<?php

namespace fendui\Routing;

/**
 * Class Router
 * @package zhiqw
 */
class Router
{
    /**
     * @var array
     */
    protected $methods = [];

    /**
     * @param string $name
     * @param $action
     * @param array $options
     * @return $this
     */
    public function add(string $name, $action, array $options = [])
    {
        if (is_string($action)) {
            $action = ['controller' => $action, 'type' => 'method'];
        } elseif (is_callable($action)) {
            $action = ['callable' => $action, 'type' => 'callable'];
        }
        $this->methods[] = $name;
        switch ($action['type']) {
            case 'callable':
                $this->addFunction($action['callable'], $name, $options);
                break;
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getMethods()
    {
        return $this->methods;
    }

    /**
     * @param callable $action
     * @param string $alias
     * @param array $options
     */
    public function addFunction(callable $action, string $alias, array $options)
    {
        app('hprose.socket_server')->addFunction($action, $alias, $options);
    }

    /**
     *
     */
    public function addMethod()
    {

    }
}