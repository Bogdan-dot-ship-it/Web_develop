<?php

namespace App\Http\Controllers\Blog\Admin;

use App\Models\BlogCategory;
use Illuminate\Support\Str;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
// use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    public function index()
    {
        $paginator = BlogCategory::paginate(5);

        return $paginator;
    }

    public function store(BlogCategoryCreateRequest $request)
    {
        $data = $request->input();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $item = (new BlogCategory())->create($data);

        if ($item) {
            return [
                'success' => true,
                'message' => 'Успішно збережено',
                'id'      => $item->id
            ];
        } else {
            return ['message' => 'Помилка збереження'];
        }
    }

    public function update(BlogCategoryUpdateRequest $request, string $id)
    {
        $item = BlogCategory::find($id);

        if (empty($item)) {
            return response()->json(['errors' => ['msg' => "Запис id=[{$id}] не знайдено"]], 404);
        }

        $data = $request->all();
        if (empty($data['slug']) && !empty($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $result = $item->update($data);

        if ($result) {
            return ['success' => 'Успішно збережено'];
        } else {
            return ['msg' => 'Помилка збереження'];
        }
    }
    public function destroy($id)
    {
        $item = BlogCategory::find($id);

        if (empty($item)) {
            return response()->json(['errors' => ['msg' => "Запис id=[{$id}] не знайдено"]], 404);
        }

        $result = $item->delete();

        if ($result) {
            return ['success' => "Запис з id {$id} успішно видалено!"];
        } else {
            return response()->json(['errors' => ['msg' => 'Помилка видалення']], 500);
        }
    }

    public function show(string $id)
    {
        $item = BlogCategory::find($id);

        if (empty($item)) {
            return response()->json(['errors' => ['msg' => "Запис id=[{$id}] не знайдено"]], 404);
        }

        return $item;
    }
}
