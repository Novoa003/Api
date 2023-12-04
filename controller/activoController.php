<?php
class ActivoController {
    private $_method; // get, post, put
    private $_complement; // get user 1 o 2
    private $_data; // datos a insertar o actualizar

    function __construct($method, $complement){
        $this->_method = $method;
        $this->_complement = $complement==null ? 0 : $complement;
        
    }
    public function index(){
        switch ($this->_method) {
            
            case "PUT":
                switch ($this->_complement) {
                    case 0:
                        echo"NO HAY USUARIO PARA ACTIVAR";
                        return ;
                    default:
                    UserModel::activarUser($this->_complement);
                    echo "USUARIO ACTIVADO";
                    
                    return ;
                }
            default:
                $json = array(
                    "ruta" => "not found"
                );
                echo json_encode($json,true);
                return;
        }
    }
}

?>

