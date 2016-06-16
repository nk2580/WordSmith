<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Routes;

use nk2580\wordsmith\Routes\Route;
use nk2580\wordsmith\Utillities\JsonResponse;

/**
 * Description of RouteGroup
 *
 * @author Nik Kyriakidis
 */
class RouteGroup {

    protected $routes = [];
    public $name;
    private $request;
    private $endpoint;

    public function __construct($name) {
        $this->name = $name;
    }

    public function add(Route $route) {
        $this->routes[] = $route;
    }

    public function routes() {
        return $this->routes;
    }

    public function run($endpoint) {
        $this->endpoint = $endpoint;
        $this->parseRequest();
        $route = $this->determineRoute();
        if ($route) {
            $route->invoke($this->request);
        } else {
            JsonResponse::showError(404, 'No route matched your request');
        }
    }

    private function parseRequest() {
        global $wp;
        $this->request = str_replace($this->endpoint, '', $wp->request);
    }

    private function determineRoute() {
        foreach ($this->routes as $r) {
            //serach post requests
            if (($_SERVER['REQUEST_METHOD'] == $r->getMethod())) {
                //then search get requests
                if ($r->matchesRequest($this->request)) {
                    return $r;
                }
            }
        }
    }

}
