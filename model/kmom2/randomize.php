<?php

class model_kmom2_randomize {
    function roll_dice($size = 6){
        return rand(1, $size);
    }
}
