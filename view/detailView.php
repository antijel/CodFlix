<?php ob_start(); ?>

<!-- <div class="row">
    <div class="col-md-4 offset-md-8">
        <form method="get">
            <div class="form-group has-btn">
                <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                       placeholder="Rechercher un film ou une série">

                <button type="submit" class="btn btn-block bg-red">Valider</button>
            </div>
        </form>
    </div>
</div> -->

<div>  
    <p><?php echo($detail[0]['title'])?></p>
    <p><?php echo($detail[0]['type'])?></p>
    <p><?php echo($detail[0]['status'])?></p>
    <p><?php echo($detail[0]['release_date'])?></p>
    <p><?php echo($detail[0]['summary'])?></p> 
</div>


<?php   
$content = ob_get_clean(); 
require('dashboard.php');
?>
