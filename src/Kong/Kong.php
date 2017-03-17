<?php

namespace Ignittion\Kong;

use Ignittion\Kong\Apis\Api;
use Ignittion\Kong\Apis\Consumer;
use Ignittion\Kong\Apis\Node;
use Ignittion\Kong\Apis\Plugin;
use Ignittion\Kong\Exceptions\InvalidUrlException;

class Kong
{
    /**
     * The port that the Kong Admin is listening on
     *
     * @var integer
     */
    protected $port;

    /**
     * The based URL to the Kong Gateway
     *
     * @var string
     */
    protected $url;

    /**
     * Array of headers that should be passed to all requests
     *
     * @var array
     */
    protected $headers;
    
    /**
     * Class Constructor
     *
     * @throws \Ignittion\Kong\Exceptions\InvalidUrlException when non-RFC
     *      compliant url is given.
     *
     * @param string $url
     * @param integer $port
     * @param array $headers
     */
    public function __construct($url, $port = 8001, $headers = [])
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new InvalidUrlException($url);
        }

        $this->port = $port;
        $this->url  = rtrim($url, '/');
        $this->headers = $headers;
    }

    /**
     * Returns a new instance of the API...api
     *
     * @return \Ignittion\Kong\Apis\Api
     */
    public function api()
    {
        return new Api($this->url, $this->port, $this->headers);
    }

    /**
     * Returns a new instance of the Consumer API
     *
     * @return \Ignittion\Kong\Apis\consumer
     */
    public function consumer()
    {
        return new Consumer($this->url, $this->port, $this->headers);
    }

    /**
     * Returns a new instance of the Node API
     *
     * @return \Ignittion\Kong\Apis\Node
     */
    public function node()
    {
        return new Node($this->url, $this->port, $this->headers);
    }

    /**
     * Returns a new instance of the Plugin API
     *
     * @return \Ignittion\Kong\Apis\Plugin
     */
    public function plugin()
    {
        return new Plugin($this->url, $this->port, $this->headers);
    }
}
