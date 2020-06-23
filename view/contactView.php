<?php ob_start(); ?>

<div>
<p>Page Contact </p>
</div>

<?php   
$content = ob_get_clean(); 
require('dashboard.php');
?>
