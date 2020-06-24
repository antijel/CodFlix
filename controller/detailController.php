<?php

require_once( 'model/media.php' );

function detail() {

    $id = isset( $_GET['media'] ) ? $_GET['media'] : null;
    $season_id = isset( $_GET['season'] ) ? $_GET['season'] : null;
    $episode_id = isset( $_GET['episode'] ) ? $_GET['episode'] : null;

    $detail = Media::detailMedias($id);

    //IF user selected an episode
    if($episode_id !== null){
        $detailEpisode = Media::detailEpisode($episode_id);
    }

    //IF user selected a serie
    if($detail[0]['type'] == 'série'){
        $episodes = Media::getEpisodes($id, $season_id);
        $tabSeason = Media::getNbSeason($id);
        $nbSeason = $tabSeason[0][0];
    }

    require('view/detailView.php');

}