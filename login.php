<?php

if (!session_id()) {
    session_start();
}
require_once __DIR__ ."/function.php";
require_once __DIR__ ."/theme/Facebook/autoload.php";

$actividad=new actividades();


$fb = new Facebook\Facebook([
  'app_id' => '638035353204558', // Replace {app-id} with your app id
  'app_secret' => 'cc89f08efd8cf1afa73adddb9209689d',
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://localhost/programacion/fb-callback.php', $permissions);




?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?php $actividad->head(); ?>
</head>
<style type="text/css">
	.container{
		text-align: center;
	}	
	#session{
		padding: 20px;
		text-decoration-line: none;
		border-radius: 5px;
		color:#fff;
		background: #3E475C;
	}
	.margin-top{
		margin-top:10%;
	}
</style>

<body class="container">
	<div class="row">
		<div class="col-12 margin-top">
			<a href="<?php echo htmlspecialchars($loginUrl); ?>" id="session">Iniciar Sesion</a>
		</div>
	</div>
	
</body>
</html>




