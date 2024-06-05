<?php


require_once('Controllers/UsuarioController.php');
require_once('Views/nav.php');
require_once('Views/dashboard.php');


?>


<?php

	
$dato = isset($_GET['da']) ? $_GET['da'] : null;

     switch($dato){

        //case of todolist
        case 1:
            require_once('Views/TodoList/create.php');
            break;


            case 2:
                require_once('Views/TodoList/insert.php');
                break;
    

                case 3:
                    require_once('Views/TodoList/edit.php');
                    break;


                    case 4:
                        require_once('Views/TodoList/delete.php');
                        break;

                        case 5:
                            require_once('Views/TodoList/search.php');
                            break;
        

                            
    
                        
                        //case of users
                                case 'usuarios':
                                    switch ($dato) {
                                case 1:
                                    require_once('Views/Users/create.php');
                                    break;
                                case 2:
                                    require_once('Views/Users/insert.php');
                                    break;
                                    case 3:
                                        require_once('Views/Users/edit.php');
                                        break;
                                        case 4:
                                            require_once('Views/Users/delete.php');
                                            default:
                                            echo "Acción no reconocida por la tarea.";
                                    }
                                    break;
                                         
     //case of users
     case 'contactos':
        switch ($dato) {
    case 1:
        require_once('Views/contact/create.php');
        break;
    case 2:
        require_once('Views/contact/insert.php');
        break;
        case 3:
            require_once('Views/contact/edit.php');
            break;
            case 4:
                require_once('Views/contact/delete.php');
                default:
                echo "Acción no reconocida por la tarea.";
        }
        break;

        default:
        //echo "Entidad no reconocida.";
}
?>
                    
	