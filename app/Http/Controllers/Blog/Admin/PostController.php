<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Repositories\BlogPostRepository;
use App\Repositories\BlogCategoryRepository;
use App\Http\Requests\BlogPostUpdateRequest;
use Illuminate\Support\Str;

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
        return $paginator;
    }

    public function update(BlogPostUpdateRequest $request, string $id)
    {
        $item = $this->blogPostRepository->getEdit($id);

        if (empty($item)) {
            return response()->json(['message' => "Запис id=[{$id}] не знайдено"], 404);
        }

        $data = $request->all();

        $result = $item->update($data);

        if ($result) {
            return [
                'success' => true,
                'message' => 'Успішно збережено'
            ];
        } else {
            return response()->json(['message' => 'Помилка збереження'], 500);
        }
    }
}
