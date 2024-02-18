# PHP MVC
Uma base de um mvc do zero feito para construir 
seus projetos rapidamente.

<img src="mvcbase.png" alt="Mvc do zero php">

## Como criar uma rota?
`routes/web.php`
```php
$routes = new RouteCollection();

$routes->add("fruits", new Route("/fruits", ["controller"=>FruitsController::class, "method"=>"showFruits"]))

$routes->add("fruits-details", new Route("/fruits/:fruitName", ["controller"=>FruitsController::class, "method"=>"fruitDetails"]))

```
> O constructor `Route` cria toda a estrutura de uma rota e passa para `RouteCollection`

## Como buscar uma rota ?
`views/fruits.php`
```html
<!-- /fruits->pathname/fruitName -->
<a href="<?= $routes->getRoute('fruits')->pathname ?>/<?= $fruit->name ?>"><?= $fruit->name ?></a>
```

## Retornando uma view
`Controllers/FruitsController.php`
```php
class FruitsController extends Controller {

    public function showFruits(RouteCollection $routes) {
        return $this->view("fruits") // o mesmo que /views/fruits.php
    }
}
```
> Para ver mais detalhes de como a função `view` e `redirect` funcionam, veja a class `Controller` em `Controllers/Controller.php`

