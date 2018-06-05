<?php
	class actividades{

		public function head(){
			require_once __DIR__ ."/theme/head.php";
		}

		public function inicio($url){
			   session_start();
   				  if($_SESSION['user']):
    				require_once "$url";

				else:
				header('Location: http://localhost/programacion/login.php');

				endif;
			}
	}
 



?>