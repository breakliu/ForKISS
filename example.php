<?php
include_once("ForKISS.php");

new ForKISS\ChunkProcess(range(1,100), 24, function($params){
    foreach ( $params as $p ) {
        echo $p . "\n";
    }
    echo "---\n";
});

