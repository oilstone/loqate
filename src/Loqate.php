<?php

namespace Oilstone\Loqate;

use BadMethodCallException;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Str;

/**
 * Class Loqate
 * @package Oilstone\Loqate
 * @method string find(array $parameters)
 * @method string retrieve(array $parameters)
 */
class Loqate
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var array
     */
    protected $defaultParameters = [
        'endpoint' => 'json',
        'Key' => null,
    ];

    /**
     * Loqate constructor.
     * @param ClientInterface $client
     * @param array $config
     */
    public function __construct(ClientInterface $client, array $config = [])
    {
        $this->config = $config;
        $this->client = $client;

        $this->defaultParameters['Key'] = $config['api_key'] ?? null;
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     * @throws GuzzleException
     */
    public function __call(string $name, array $arguments)
    {
        if (isset($this->config['requests'][$name]) && is_array($arguments[0] ?? null)) {
            $parameters = array_merge($this->defaultParameters, $arguments[0]);
            $endpoint = $this->config['endpoint'][$parameters['endpoint'] ?? 'json'];

            unset($parameters['endpoint']);

            return $this->request($this->config['url'], $this->config['requests'][$name], $endpoint, $parameters);
        }

        throw new BadMethodCallException('No such request type exists or invalid parameters have been specified');
    }

    /**
     * @param string $url
     * @param string $request
     * @param string $endpoint
     * @param array $parameters
     * @return string
     * @throws GuzzleException
     */
    public function request(string $url, string $request, string $endpoint, array $parameters = []): string
    {
        $requestUrl = Str::finish($url, '/') . Str::finish($request, '/') . Str::finish($endpoint, '?') . http_build_query($parameters);

        return (string) $this->client->request('get', $requestUrl)->getBody();
    }
}

