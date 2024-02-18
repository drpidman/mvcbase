<?php

namespace App\Controllers;

class Controller
{
    /**
     * ## Retornando uma visualização
     * ```php
     * <?php
     * class FruitsController extends Controller {
     *      public function showFruits(RoutesCollection $routes)
     *      {
     *          return $this->view("fruits"); // o mesmo que na pasta: /views/fruits.php
     *      }
     *      // usando parametros da URL e retornando um item
     *      public function showFruitDetails(RoutesCollection $routes)
     *      {
     *          $fruitName = $routes->getRoute("fruits-details-page")->params[0]; // caso tenha definido: /fruits/:fruitName
     *          $fruit = (new FruitsModel())->findByName($fruitName);
     *          return $this->view("fruits/fruitdetails", ["fruit"=> $fruit]); // o mesmo que na pasta /views/fruits/fruitdetails.php
     *      }
     *  }
     * ?>
     * ```
     * -----------------------------------
     * ### Em `fruitsdetails.php`:
     * ```html
     *  <h1>Fruit name is: <?= $fruit->name ?></h1>
     * ```
     * -----------------------------------
     * 
     * @param string $view_name O nome da visualização correspondente em `/views/`
     * @param array $args Extrair os argumentos em variavéis dentro da visualização
     */
    public function view(string $view_name, array $args = [])
    {
        extract($args);
        include_once "../views/" . $view_name . ".php";
    }
    /**
     * ## Redirecionando
     * -----------------------
     * ```php
     * $this->redirect($routes->getRoute("fruits-page")->pathname); // /fruits
     * ```
     * -----------------------
     */
    public function redirect(string $path)
    {
        header("Location:" . $path);
    }
}
