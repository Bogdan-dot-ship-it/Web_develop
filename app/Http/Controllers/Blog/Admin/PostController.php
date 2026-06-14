<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use Illuminate\Support\Str;
use App\Models\BlogPost;
use App\Http\Requests\BlogPostCreateRequest;
use App\Jobs\BlogPostAfterCreateJob;
use App\Jobs\BlogPostAfterDeleteJob;
use App\Http\Resources\Api\Blog\Admin\PostResource;
class PostController extends BaseController
{
    public function __construct(
        private BlogPostRepository $blogPostRepository,
        private BlogCategoryRepository $blogCategoryRepository
    ) {
        // parent::__construct();
    }

    public function index()
    {
        $paginator = $this->blogPostRepository->getAllWithPaginate();
        return PostResource::collection($paginator);
    }

    public function update(BlogPostUpdateRequest $request, string $id)
    {
        try {
            $item = BlogPost::find($id);

            if (empty($item)) {
                return response()->json(['message' => "Запис id=[{$id}] не знайдено"], 404);
            }

            $data = $request->validated();
            $result = $item->update($data);

            if ($result) {
                return response()->json(['success' => true, 'message' => 'Успішно збережено'], 200);
            }

            return response()->json(['message' => 'Невідома помилка збереження'], 500);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Помилка БД: ' . $e->getMessage()], 500);
        }
    }

    public function store(BlogPostCreateRequest $request)
    {
        try {
            $data = $request->validated();

            if (!isset($data['user_id'])) {
                $data['user_id'] = 1;
            }

            $item = BlogPost::create($data);

            if ($item) {
                dispatch(new BlogPostAfterCreateJob($item));
                return response()->json(['success' => 'Успішно збережено'], 201);
            }

            return response()->json(['message' => 'Невідома помилка збереження'], 500);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Помилка БД: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $item = BlogPost::with(['user', 'category'])->find($id);

        if (empty($item)) {
            return response()->json(['message' => 'Запис не знайдено'], 404);
        }

        return new PostResource($item);
    }

    public function destroy($id)
    {
        $result = BlogPost::destroy($id);

        if ($result) {
            BlogPostAfterDeleteJob::dispatch($id)->delay(20);

            return response()->json(['success' => "Статтю з id {$id} успішно видалено"]);
        } else {
            return response()->json(['msg' => 'Помилка видалення. Можливо, запис не знайдено'], 404);
        }
    }
}
