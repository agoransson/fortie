<?php

namespace Wetcat\Fortie\Transports;

/*

   Copyright The Fortie authors

   Licensed under the Apache License, Version 2.0 (the "License");
   you may not use this file except in compliance with the License.
   You may obtain a copy of the License at

       http://www.apache.org/licenses/LICENSE-2.0

   Unless required by applicable law or agreed to in writing, software
   distributed under the License is distributed on an "AS IS" BASIS,
   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
   See the License for the specific language governing permissions and
   limitations under the License.

*/

use GuzzleHttp\Client;

/**
 * Guzzle transport implementation.
 */
class GuzzleTransportImpl implements ITransport
{
    private $client = null;

    /**
     * Construct a new Guzzle transport.
     *
     * @return void
     */
    public function __construct(
        $endpoint,
        $access_token,
        $client_secret,
        $content_type,
        $accepts,
        $config = []
    ) {
        $this->client = new Client(array_merge([
            'base_uri' => $endpoint,
            'headers' => [
                'Access-Token' => $access_token,
                'Client-Secret' => $client_secret,
                'Content-Type' => $content_type,
                'Accept' => $accepts,
            ],
            'timeout' => 3.0,
        ], $config));
    }

    public function get(string $url): array
    {
        return $this->client->get($url);
    }

    public function post(string $url, array $data = []): object
    {
        return $this->client->post($url, $data);
    }

    public function put(string $url, array $data = []): object
    {
        return $this->client->put($url, $data);
    }

    public function patch(string $url, array $data = []): object
    {
        return $this->client->patch($url, $data);
    }

    public function delete(string $url): bool
    {
        return $this->client->delete($url);
    }
}
