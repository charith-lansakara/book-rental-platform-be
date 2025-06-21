<?php

namespace App\Services;
use App\Repositories\BookRepository;


class BookService {
    public function __construct(protected BookRepository $repository) {}

    public function getAll($filters)
    {
        return $this->repository->all($filters);
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function rent($id)
    {
        return $this->repository->rent($id);
    }

    public function return($id)
    {
        return $this->repository->return($id);
    }

    public function summary()
    {
        return $this->repository->summary();
    }
}