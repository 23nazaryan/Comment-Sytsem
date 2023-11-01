<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Comment\CommentResource;
use App\Repositories\Interfaces\CrudRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private readonly CrudRepositoryInterface $commentRepository){}

    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $response = $this->commentRepository->getAll($request);

        return view('comment.list', [
            'comments' => new CommentCollection($response)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCommentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCommentRequest $request): RedirectResponse
    {
        $this->commentRepository->create($request->validated());

        return back();
    }

    /**
     * Display the specified resource.
     * @param Comment $comment
     * @return View
     */
    public function show(Comment $comment): View
    {
        return view('comment.index', [
            'comment' => new CommentResource($comment)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param Comment $comment
     * @return RedirectResponse
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $this->commentRepository->delete($comment);

        return back();
    }
}
