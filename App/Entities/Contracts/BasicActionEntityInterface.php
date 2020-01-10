<?php
namespace App\Entities\Contracts;

interface BasicActionEntityInterface
{
    public function select(array $column = ['*']);
    public function selectWhere(string $columnWhere, $value, array $column = ['*']);
    public function delete(string $column, $value);
    public function insert(array $args);
    public function update(array $args, $value, string $column = 'id');
}