<?php

namespace App;

interface RouteCollection
{
    function getRoute(string $routename);
    function getAll();
    function add(string $name, Route $route);
}

class Route
{
    public $pathname;
    public $controller;
    public $method;
    public $params;

    /**
     * ## Criando uma rota
     * ```php
     * <?php
     * new Route("/fruits", ["controller"=>FruitsController::class, "method"=>"showFruits"]))
     * new Route("/fruits/:fruitName", ["controller"=>FruitsController::class, "method"=>"fruitDetails"]))
     * ?>
     * ```
     * -----------------------
     * @param string $pathname O caminho da rota na pagina por exemplo: `/home`, `/usuario/:userid/perfil`
     * @param array $argsc Parametros adicionais da rota como controller e o metodo
     */
    public function __construct(string $pathname, array $argsc)
    {
        $this->pathname = $pathname;
        $this->controller = $argsc["controller"];
        $this->method = $argsc["method"];
        $this->params = isset($argsc["params"]) ? $argsc["params"] : null;

        return $this;
    }
}
/**
 * ## Adicionando rotas
 * ```php
 * <?php
 * $routes = new RouteCollection();
 * $routes->add("fruits-page", new Route("/fruits", ["controller"=>FruitsController::class, "method"=>"showFruits"]))
 * ?>
 * ```
 * --------------------------
 * ### No controlador:
 * ```php
 * <?php
 * class FruitsController extends Controller {
 *      public function showFruits(){
 *          // code
 *      }
 *  }
 * ?>
 * ```
 * --------------------------
 */
class RoutesCollection implements RouteCollection
{
    public $routes = [];

    /**
     * @return array Retorna o array de rotas
     */
    public function __construct()
    {
        return $this->routes;
    }

    /**
     * ## Adicionando rotas
     * ```php
     * <?php
     * $routes = new RouteCollection();
     * $routes->add("fruits-page", new Route("/fruits", ["controller"=>FruitsController::class, "method"=>"showFruits"]))
     * ?>
     * ```
     * --------------------------
     * ### No controlador:
     * ```php
     * <?php
     * class FruitsController extends Controller {
     *      public function showFruits(){
     *          // code
     *      }
     *  }
     * ?>
     * ```
     * ---------------------------
     * @param string $name Nome amigável para a rota. Usada para busca mais tarde em alguma página;
     * @param Route $route Constructor da rota, onde vai conter o caminho, parametros, etc...
     */
    public function add(string $name, Route $route)
    {
        $this->routes[$name] = $route;
    }

    /**
     * @return array - Retorna todas as rotas adicionadas
     */
    public function getAll()
    {
        return $this->routes;
    }

    /**
     * ## Buscando uma rota
     * ```
     * <?php
     * $routes = new RouteCollection();
     * $routes->add("fruits-page", new Route("/fruits", ["controller"=>FruitsController::class, "method"=>"showFruits"]));
     * ?>
     * ```
     * --------------------------
     * ### Em outro arquivo por exemplo...
     * ```
     * <?php
     * $routes->getRoute("fruits-page")->pathname; 
     * $routes->getRoute("fruits-info-view")->params[0];// ou para parametros.... Que seria /fruits/:fruitname. 
     * $routes->getRoute("fruits-page")->controller; // para retornar o controlador
     * ?>
     * ```
     * --------------------------
     * @param string $routename Busca uma rota pelo nome definido anteriormente
     * @return Route
     */
    public function getRoute(string $routename)
    {
        return $this->routes[$routename];
    }
}
