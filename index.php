<?php
//Inicializador

use CRUD\controller\Controller;

try{
    $autoload = "./vendor/autoload.php";

    //Verificar se existe o autoload do composer
    if(!file_exists($autoload))
        throw new Exception('O composer autoload não foi encontrado!');

    //Carregar autoload das classes php
    require_once $autoload;

    //Verificar se o metodo a ser chamado foi requisitado no get
    $method = isset($_GET['method'])  ? $_GET['method'] : 'index';
    //Verificar se o metodo a ser chamado não está vazio
    $method = !empty($_GET['method']) ? $method         : 'index';
    //Transformar a primeira letra em maiúscula
    $method = ucfirst(strtolower($method));
    //Remover espaços em branco
    $method = str_replace(" ", "", $method);

    //Verificar se a ação a ser chamada foi requisitada no get
    $action = isset($_GET['action'])  ? $_GET['action'] : 'index';
    //Verificar se a ação a ser chamada não está vazia
    $action = !empty($_GET['action']) ? $action         : 'index';
    //Transformar a ação em letras em minúsculas
    $action = strtolower($action);
    //Remover espaços em branco
    $action = str_replace(" ", "", $action);

    //Verificar se existe a controller
    if(!file_exists("./app/controller/{$method}Controller.php"))
        throw new Exception("O {$method} não foi encontrado!");

    //Definir o namespace da controller
    $controllerName = "\\CRUD\\controller\\{$method}Controller";

    //Instanciar a controller
    $controller = new $controllerName();

    //Verificar se a controller é filha da Controller principal
    if (!$controller instanceof Controller)
        throw new Exception("A controller não atende aos requisitos do CRUD.");

    elseif(!method_exists($controller, "{$action}Action"))
        throw new Exception("A action {$action} não foi encontrada na controller {$method}.");

    $controller->getView()->setPage(strtolower($method));
    $controller->getView()->setAction(strtolower($action));

    //Colocando a action na estrutura correta
    $action = "{$action}Action";

    //Chamar ação
    $return = $controller->$action();

    //Verificar se o retorno é uma view e executa-la
    if($return instanceof \CRUD\view\View){
        $return->render();
    }
    //Verificar se é um array, e transformar em json
    elseif(is_array($return)) {
        header('Content-Type: application/json');
        echo json_encode($controller->sendJSON($return));
    }
    //Verificar se é uma string e exibi-la
    elseif(is_string($return)){
        echo $return;
    }
    //Depurar objeto
    elseif($return != "") {
        var_dump($return);
    }

} catch (Exception $e){
    die($e->getMessage());
}