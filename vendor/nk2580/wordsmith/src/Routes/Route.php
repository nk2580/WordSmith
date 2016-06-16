<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Routes;

use nk2580\wordsmith\Routes\RouteFactory;

/**
 * Description of Route
 *
 * @author Nik Kyriakidis
 */
class Route {

    protected $method;
    protected $uri;
    protected $group;
    protected $action;
    protected $parameters;

    public function __construct($method, $group, $uri, $action) {
        $this->method = $method;
        $this->uri = $uri;
        $this->group = $group;
        $this->action = $action;
    }

    public function getGroup() {
        return $this->group;
    }

    public function getURI() {
        return $this->uri;
    }

    public function getAction() {
        return $this->action;
    }

    public function getMethod() {
        return $this->method;
    }

    public static function get($group, $uri, $action) {
        $route = new self('GET', $group, $uri, $action);
        RouteFactory::addRoute($route);
    }

    public static function post($group, $uri, $action) {
        $route = new self('POST', $group, $uri, $action);
        RouteFactory::addRoute($route);
    }
    
    public function invoke($request) {
        if (is_object($this->action) && ($this->action instanceof Closure)) {
            $this->action();
        } else {
            $parts = $pieces = explode("@", $this->action);
            $class = $parts[0];
            $method = $parts[1];
            $obj = new $class();
            if ($this->hasParameters()) {
                $this->setupParams($request);
                call_user_func_array(array($obj, $method), $this->parameters);
            } else {
                $obj->$method();
            }
        }
    }

    public function matchesRequest($request) {
        if ($request == $this->getURI()) {
            return true;
        } else if ($this->hasParameters()) {
            return preg_match($this->regexURI(), $request);
        } else {
            return false;
        }
    }

    private function hasParameters() {
        return preg_match('/\{(.*?)\}/', $this->uri);
    }

    public function regexURI() {
        $raw = preg_replace('/\{(.*?)\}/', "([a-zA-Z0-9]+)", $this->uri);
        $processed = preg_replace("/\//", "\/", $raw);
        return "/" . $processed . "$/";
    }

    private function setupParams($request) {
        $params = array();
        preg_match($this->regexURI(), $request, $params);
        unset($params[0]);
        $this->parameters = $params;
    }

}
