<?php

namespace App\Entities\Contracts;

interface BasicActionEntityInterface
{
    public function select(array $columns = ['*']): array;
    public function selectWhere(string $column, $value, array $columns = ['*']): array;
    public function delete(string $column, $value): bool;
    public function insert(array $values): bool;
    public function update(array $values, $id, string $column = 'id'): bool;
}
