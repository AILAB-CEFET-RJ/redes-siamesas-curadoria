<?php

function get_image_size($filename){
    return getimagesize("imagenet/" . $filename);
}

function get_bbox_coordinates($bbox, $image_size){
    $box = array();

    $box["x1"] = intval($bbox->x1 * $image_size[0]);
    $box["x2"] = intval($bbox->x2 * $image_size[0]);

    $box["y1"] = intval($bbox->y1 * $image_size[1]);
    $box["y2"] = intval($bbox->y2 * $image_size[1]);

    return $box;
}

function draw_bound_box($image, $x1, $x2, $y1, $y2){
    imagerectangle( $image , $x1 , $y1 , $x2 , $y2 , $color ); 
}

?>