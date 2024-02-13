<?php
require_once('Controllers/UsuarioController.php');
require_once('Views/nav.php');
require_once('Views/head.php');


?>

<?php

	
$dato = isset($_GET['da']) ? $_GET['da'] : null;

     switch($dato){

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
        
                            case 6:
                                require_once('Views/Categoria/create.php');
                                break;
                            case 7:
                                require_once('Views/Categoria/insert.php');
                                break;
                                case 8:
                                    require_once('Views/Categoria/edit.php');
                                    break;
                                    case 9:
                                        require_once('Views/Categoria/delete.php');
                                        break;
     }


	
		

?>




