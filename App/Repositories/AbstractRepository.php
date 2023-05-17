<?php

namespace App\Repositories;

use System\Factory;
use App\Repositories\Contracts\RepositoryBasicActionInterface;
use App\Entities\Contracts\BasicActionEntityInterface;
abstract class AbstractRepository implements RepositoryBasicActionInterface
{
    /** @var BasicActionEntityInterface */
    protected $entity;

    public function __construct(string $entityName, array $args)
    {
        $this->entity = Factory::setupEntity($entityName, $args);
    }

    public function __destruct()
    {
        $this->entity = null;
    }

    /**
     * Store a new Entity
     * @param array $attributes
     * @return bool
     */
    public function create(array $attributes): bool
    {
        return $this->entity->insert($attributes);
    }

    /**
     * Find a entity by id
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->entity->selectWhere('id', $id);
    }

    /**
     * Update a entity in db, find by id
     * @param int $id
     * @param array $attributes
     * @return bool
     */
    public function updateById(int $id, array $attributes): bool
    {
        return $this->entity->update($attributes, $id, 'id');
    }

    /**
     * Delete a entity, find by id
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id): bool
    {
        return $this->entity->delete('id', $id);
    }

    /**
     * Get all records
     * @param array $columns
     * @return mixed
     */
    public function getAll(array $columns = ['*'])
    {
        return $this->entity->select($columns);
    }

    /**
     * Find entities by column value
     * @param string $column
     * @param mixed $value
     * @return mixed
     */
    public function findByColumn(string $column, $value)
    {
        return $this->entity->selectWhere($column, $value);
    }
}
