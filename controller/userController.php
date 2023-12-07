<?php
class UserController{
    private $_method; 
    private $_complement; 
    private $_data; 

    function __construct($method, $complement, $data){
        $this->_method = $method;
        $this->_complement = $complement==null ? 0 : $complement;
        $this->_data = $data !=0 ? $data : "";
    }

    public function index(){
        switch ($this->_method) {
            case "GET":
                switch ($this->_complement) {
                    case 0:
                        $user = UserModel::getUsers(0);
                        $json = $user;
                        echo json_encode($user);
                        return ;
                    default:
                    $user = UserModel::getUsers($this->_complement);
                    $json = $user;
                    echo json_encode($user);
                    return ;
                }
            case "POST":
                $createUser = UserModel::createUser ($this->generateSalting());
                $json = array(
                    "response" => $createUser
                );    
                echo json_encode($json,true);
                return;
            case "PUT":
                switch ($this->_complement) {
                    case 0:
                        echo"NO HAY USUARIO PARA ACTUALIZAR";
                        return ;
                    default:
                    UserModel::updateUser($this->_complement,$this->_data);
                    echo "USUARIO ACTUALIZADO";
                    return ;
                }
            case "DELETE":
                switch ($this->_complement) {
                    case 0:
                        echo"NO HAY USUARIO PARA ELIMINAR";
                        return ;
                    default:
                    UserModel::deleteUser($this->_complement);
                    echo "USUARIO ELIMINADO";
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

    private function generateSalting(){
        $trimmed_data="";
        if(($this->_data != "") || (!empty($this->_data))){
            $trimmed_data = array_map('trim',$this->_data);
            $trimmed_data['use_pss'] = md5($trimmed_data['use_pss']);
            $identifier = str_replace("$","y78",crypt( $trimmed_data['use_mail'],'ser3478'));
            $key = str_replace("$","ERT",crypt( $trimmed_data['use_pss'],'resarial2024'));
            $trimmed_data['us_identifier']=$identifier;
            $trimmed_data['us_key']=$key;
            return $trimmed_data;
        }
    }

} 


?>
