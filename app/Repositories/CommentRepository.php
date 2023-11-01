<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentRepository implements CrudRepositoryInterface
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $limit = $request->get('limit', 25);

        return Comment::query()->with('parent', 'user')
            ->whereNull('parent_id')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);
    }

    /**
     * @param array $requestData
     * @return Builder|Model
     */
    public function create(array $requestData): Builder|Model
    {
        $comment = new Comment($requestData);
        Auth::user()->comments()->save($comment);
        return $comment;
    }

    /**
     * @param Builder|Model $item
     * @param array $requestData
     * @return void
     */
    public function update(Builder|Model $item, array $requestData): void
    {
        $item?->update($requestData);
    }

    /**
     * @param Builder|Model $item
     * @return void
     */
    public function delete(Builder|Model $item): void
    {
        $item?->delete();
    }
}
