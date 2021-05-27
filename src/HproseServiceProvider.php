<?php

namespace fendui;

use Carbon\Laravel\ServiceProvider;
use fendui\Commands\SocketCommand;
use fendui\Routing\Router;
use fendui\Services\SocketServer;


/**
 * Class HproseServiceProvider
 * @package fendui
 */
class HproseServiceProvider extends ServiceProvider
{

    /**
     *
     */
    public function boot()
    {

        $this->loadRoute();

        $this->commands([
            SocketCommand::class
        ]);
    }

    public function register()
    {

        $this->loadConfig();
        $this->loadDefaultRpcRoute();

        $this->app->singleton('hprose.router', function ($app) {
            return new Router();
        });

        $this->app->singleton('hprose.socket_server', function ($app) {
            $service = new SocketServer();
            $service->onSendError = function ($error, \stdClass $context) {

            };
            $uris = config('hprose.server.tcp_uris');
            array_map(function ($url) use (&$service) {
                $service->addListener($url);
            }, $uris);
            return $service;
        });
    }


    public function loadRoute()
    {
        $files = config('hprose.server.routepath');
        if (is_array($files)) {
            foreach ($files as $file) {
                if (is_file($file)) {
                    require $file;
                }
            }
        }
    }


    public function loadConfig()
    {
        $source = realpath(__DIR__ . '/config.php');
        $this->publishes([$source => config_path('hprose.php')]);
        $this->mergeConfigFrom($source, 'hprose');
    }

    public function loadDefaultRpcRoute()
    {
        $source = realpath(__DIR__ . '/route.php');
        $this->publishes([$source => base_path('rpc/hello.php')]);
    }
}
