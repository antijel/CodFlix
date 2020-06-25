<?php ob_start(); ?>

<div>
<h1> Contact </h1>
</div>

<a href = 'mailto:contact@codflix.com'><P>Cliquez ici pour nous envoyer un mail</P></a>

<?php   
$content = ob_get_clean(); 
require('dashboard.php');
?>
