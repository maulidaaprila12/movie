<?php

namespace App\Interfaces;

interface MovieRepositoryInterface
{
    public function getAll();
    public function paginate();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}