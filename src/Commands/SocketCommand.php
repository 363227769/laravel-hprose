<?php

namespace fendui\Commands;

use fendui\Facades\HproseRoute;
use Illuminate\Console\Command;

/**
 * Class Socket
 * @package zhiqw
 */
class SocketCommand extends Command
{

    /**
     * @var string
     */
    protected $signature = 'hprose:socket_server';

    /**
     * @var string
     */
    protected $description = 'socket 服务';

    /**
     *
     */
    public function handle()
    {
        $this->output->writeln(sprintf(' - Laravel=<info>%s</>', app()::VERSION), $this->parseVerbosity(null));
        $this->output->newLine();
        $uris = config('hprose.server.tcp_uris');
        foreach ($uris as $uri) {
            $this->line(sprintf(' - <info>%s</>', $uri));
        }
        $this->comment('可调用远程方法:');
        $methods = HproseRoute::getMethods();
        if ($methods) {
            foreach ($methods as $method) {
                $this->line(sprintf(' - <info>%s</>', $method));
            }
            $this->output->newLine();
        } else {
            $this->line(sprintf(' - <info>无可调用方法</>'));
        }
        app('hprose.socket_server')->start();
    }
}