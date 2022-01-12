<?php

interface db_interface {
    public function __construct();
    public function insert($person);
    public function update($person);
    public function getByPrivacy();
    public function getByID($id);
    public function delete($id);
}

?>