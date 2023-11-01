<?php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

interface CrudRepositoryInterface
{
    public function getAll(Request $request): LengthAwarePaginator;

    public function create(array $requestData): Builder|Model;

    public function update(Builder|Model $item, array $requestData): void;

    public function delete(Builder|Model $item): void;
}
