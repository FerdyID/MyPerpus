<?php
//fungsi yg dipanggil

namespace App\Domain\Repositories;

interface AbstractInterface
{
    public function getAll();
    
    public function getById($id);
    
    public function getByField($att, $field);
    
    public function create(array $attributes);
    
    public function update($id, array $attributes);
    
    public function delete($id);
}