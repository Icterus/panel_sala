<?php

class Reportes extends ActiveRecord {
    protected $logger = true;
    public function lista(){
        return $this->find();
    }
}

?>