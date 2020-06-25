<?php ob_start(); ?>

<div>
<p>Page Contact </p>
</div>

<a href = 'mailto:contact@codflix.com'><P>Contactez-nous!</P></a>

<?php   
$content = ob_get_clean(); 
require('dashboard.php');
?>
