<?php

interface db_interface {
    public function __construct();
    public function insert($person);
    public function update($person);
    public function getAllPublic();
    public function getByID($id);
    public function delete($id);
}

?>