<?php namespace Wetcat\Fortie\Transports;

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

/**
 * A generic transport interface; this way we can select which kind of transport
 * client we want to use in our projects. This is a very generic interface that
 * defines the five different HTTP methods by which we interact with the
 * Fortnox backend.
 */
interface ITransport
{

    /**
     * Perform a HTTP GET request.
     */
    public function get(string $url) : array;


    /**
     * Perform a HTTP POST request.
     */
    public function post(string $url, array $data = []) : Object;


    /**
     * Perform a HTTP PUT request.
     */
    public function put(string $url, array $data = []) : Object;


    /**
     * Perform a HTTP PATCH request.
     */
    public function patch(string $url, array $data = []) : Object;


    /**
     * Perform a HTTP DELETE request.
     */
    public function delete(string $url) : bool;

}
