<?php

namespace App\Domain\Repository;

interface IRepository {
    public function find($id);
    public function save();
}