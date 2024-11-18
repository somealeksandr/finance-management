<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * Constructor for transferring the model.
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
        //
    }

    /**
     * Returns all records.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Finds a record by ID.
     *
     * @param  int $id
     * @return Model|null
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Creates a new record.
     *
     * @param  array $payload
     * @return Model
     */
    public function create(array $payload): Model
    {
        return $this->model->create($payload);
    }

    /**
     * Updates an existing record.
     *
     * @param  int $id
     * @param  array $payload
     * @return void
     */
    public function update(int $id, array $payload): void
    {
        //
    }

    /**
     * Deletes a record by ID.
     *
     * @param  int $id
     * @return void
     */
    public function delete(int $id): void
    {
        //
    }
}
