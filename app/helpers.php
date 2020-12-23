<?php

use function PHPUnit\Framework\fileExists;

function productImage($path){
    return ($path != null) && file_exists('storage/'.$path) ? asset('storage/'.$path):asset('images/noimage.png');
}
