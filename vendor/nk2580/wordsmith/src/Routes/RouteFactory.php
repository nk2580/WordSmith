<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace nk2580\wordsmith\Routes;

/**
 * Description of RouteCollection
 *
 * @author Nik Kyriakidis
 */
class RouteFactory {

    public static function fetchGroup($group) {
        $status = false;
        $groups = RouteFactory::all();
        if (!empty($groups)) {
            foreach ($groups as $g) {
                if ($g->name == $group) {
                    $status = $g;
                    break;
                }
            }
        }
        return $status;
    }

    public static function createGroup($group) {
        $obj = new RouteGroup($group);
        $GLOBALS['_cc_routes'][$group] = $obj;
        return $obj;
    }

    public static function addRoute(Route $route) {
        $group = $route->getGroup();
        $RouteGroup = RouteFactory::fetchGroup($group);
        if (!$RouteGroup) {
            $g = RouteFactory::createGroup($group);
            $g->add($route);
        } else {
            $RouteGroup->add($route);
        }
    }

    public static function all() {
        $OBJ = $GLOBALS['_cc_routes'];
        return $OBJ;
    }

    public static function init() {
        if (!is_array($GLOBALS['_cc_routes'])) {
            $GLOBALS['_cc_routes'] = [];
        }
    }
    
    public static function implementRouteGroup($group, $endpint, $namespace = ""){
        $obj = RouteFactory::fetchGroup($group);
        $obj->run($endpint);
    }

}
