<?php

require_once( 'model/media.php' );

function detail() {

    $id = isset( $_GET['media'] ) ? $_GET['media'] : null;

    $detail = Media::detailMedias($id);

    require('view/detailView.php');

}