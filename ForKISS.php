<?php
namespace ForKISS;

class ChunkProcess {
    private $_val = NULL;
    private $_func = NULL;

    function __construct($mass_array, $max_nums, $func) {
        $this->_func = $func;
        $pool = [];
        $size = round( count($mass_array) / $max_nums );

        foreach ( array_chunk($mass_array, $size) as $arr ) {
            $this->_val = $arr;

            $process = new \Swoole\Process(function (\Swoole\Process $child) {
                echo sprintf("Child Process ID: %d \n", $child->pid);
                call_user_func($this->_func, $this->_val);
            });

            $process->start();

            $pool[] = $process;
        }

        foreach ( $pool as $p ) {
            $p->wait();
        }
    }
}
