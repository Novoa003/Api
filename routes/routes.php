<?php
// Detecta nuesta url 
$rutasArray =explode("/",$_SERVER['REQUEST_URI']);
$inputs = array(); 
//Raw input for requests
$inputs['raw_input'] = @file_get_contents('php://input');
$_POST = json_decode($inputs['raw_input'], true);
if (count(array_filter($rutasArray)) < 2){
    $json = array(
        "ruta" => "not found"
    );
    echo json_encode($json,true);
    return;
}else{
    //EndPoint Correctos 
    $endPoint = (array_filter($rutasArray)[2]);
    $complement = (array_key_exists(3,$rutasArray)) ? ($rutasArray)[3]:0;
    $add = (array_key_exists(4,$rutasArray)) ? ($rutasArray)[4]:"";
    if($add != "") $complement .= "/".$add;
    $method = $_SERVER['REQUEST_METHOD'];
    switch($endPoint){
        case'users':
            if(isset($_POST))
                $user = new UserController($method,$complement,$_POST);
            else
                $user = new UserController($method,$complement,0);
            $user->index();
            break;
        case'login':
            if(isset($_POST) && $method=='POST'){
                $user = new LoginController($method,$_POST);
                $user->index();
            }else{
                $json = array(
                    "ruta" => "not found"
                );
                echo json_encode($json,true);
                return;
            }
            break;
        case "activo":
            if(isset($_POST)){
                $user = new ActivoController($method,$complement);
                $user->index();
            }else{
                $json = array(
                    "ruta" => "not found"
                );
                echo json_encode($json,true);
                return;
            }
            break;
        default:    
            $json = array(
                "ruta" => "not found"
            );
            echo json_encode($json,true);
            return;
    }
}
?>