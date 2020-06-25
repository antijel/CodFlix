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

    <!-- INFORMATIONS EPISODE-->
<?php if(isset($detailEpisode)){ ?>
<div>  
    <div>
    <iframe allowfullscreen="true" frameborder="0"
            src="<?= $detailEpisode[0]['media_url']; ?>" ></iframe>
    </div>
    <h1><?php echo($detailEpisode[0]['title'])?></h1>
    <p><?php echo("Saison : " .$detailEpisode[0]['season'])?></p>
    <p><?php echo("Episode : " .$detailEpisode[0]['episode'])?></p>
    <p><?php echo($detailEpisode[0]['release_date'])?></p>
    <p><?php echo($detailEpisode[0]['summary'])?></p> 
</div>
<?php }else{ ?>

    <!--INFORMATIONS MEDIA  -->
<div>  
    <div>
    <iframe allowfullscreen="true" frameborder="0"
            src="<?= $detail[0]['trailer_url']; ?>" ></iframe>
    </div>
    <h1><?php echo($detail[0]['title'])?></h1>
    <p><?php echo($detail[0]['type'])?></p>
    <p><?php echo($detail[0]['status'])?></p>
    <p><?php echo($detail[0]['release_date'])?></p>
    <p><?php echo($detail[0]['summary'])?></p> 

</div>

    <!-- INFORMATIONS SEASON -->
<?php } if($detail[0]['type'] == 'série' && !isset($detailEpisode)){?>

        <!-- SELECT SEASON -->
<select name="season" onchange="location = this.value;">

    <?php 
    $i=1;
    if($season_id == null){ // If it's the first details page for series

        echo('<option selected value="index.php?media='. $detail[0]["id"] .'">Tout</option>');
            
        while($i <= $nbSeason){
            echo('<option value="index.php?media='. $detail[0]["id"] .'&season='.$i.'">Saison '.$i.'</option>');
            $i++;
        }

    }else{ // If user already selected a season

        echo('<option value="index.php?media='. $detail[0]["id"] .'">Tout</option>');

        while($i <= $nbSeason){

            if($season_id == $i ){
                echo('<option selected value="index.php?media='. $detail[0]["id"] .'&season='.$i.'">Saison '.$i.'</option>');
            }else{
                echo('<option value="index.php?media='. $detail[0]["id"] .'&season='.$i.'">Saison '.$i.'</option>');
            }

            $i++;
        }

    }
    ?>

</select>

<!-- EPISODE LIST -->
<div class="media-list">
    <?php foreach( $episodes as $episode ):?>
        <a class="item" href="index.php?media=<?= $detail[0]['id']; ?>&episode=<?= $episode['id']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $episode['media_url']; ?>" ></iframe>
                </div>
            </div>
            <div class="title"><?= $episode['title']; ?></div>
        </a>
    <?php endforeach; ?>
</div>



<?php   
}
$content = ob_get_clean(); 
require('dashboard.php');
?>
