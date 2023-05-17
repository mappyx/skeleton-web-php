<?php

namespace App\Repositories\Contracts;

interface RepositoryBasicActionInterface
{
    /**
     * Store a new Entity
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Find a entity by id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Update a entity in db, find by id
     * @param array $attributes
     * @param int $id
     * @return bool
     */
    public function updateById(int $id, array $attributes): bool;

    /**
     * Delete a entity, find by id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool;

    /**
     * Get all records
     * @param array $columns
     * @return mixed
     */
    public function getAll(array $columns = ['*']);

    /**
     * Find entities by column value
     * @param string $column
     * @param mixed $value
     * @return mixed
     */
    public function findByColumn(string $column, $value);
}
