<?php

interface db_interface {
    public function insert($person);
    public function update($person);
    public function get($id);
    public function delete($id);
}

?>