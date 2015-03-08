<?php namespace lib\linnworks;

class Test{

    protected $testid;
        public function __construct($id){
            $this->testid=$id;
        }

    public function showid(){
        return $this->testid;
    }
}