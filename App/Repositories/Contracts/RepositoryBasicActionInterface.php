<?php
namespace App\Repositories\Contracts;

interface RepositoryBasicActionInterface
{
    /**
     * Store a new Entity
     * @param array $params
     * @return mixed
     */
    public function create(array $params);

    /**
     * Delete a entity, find by id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id);

    /**
     * Update a entity in bd, find by id
     * @param array $params
     * @param int $id
     * @return mixed
     */
    public function updateById(array $params, int $id);

    /**
     * Find a entity by id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * Get all records
     * @param array $columns
     * @return mixed
     */
    public function getAllRecord($columns = ['*']);

    /**
     * Find By a Column name
     * @param string $nameColumn
     * @param mixed $data
     * @return mixed
     */
    public function findByColumnName(string $nameColumn, $data);
}