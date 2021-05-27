<?php

namespace fendui\Services;

use Hprose\Socket\Server;

/**
 * Class SocketServer
 * @package zhiqw
 */
class SocketServer extends Server
{
    /**
     * SocketServer constructor.
     * @param null $uri
     */
    public function __construct($uri = null)
    {
        parent::__construct($uri);
        $this->uris = [];
        if ($uri) {
            $this->addListener($uri);
        }
    }

}