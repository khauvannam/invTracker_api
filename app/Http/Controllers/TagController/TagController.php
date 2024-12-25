<?php
namespace App\Http\Controllers\TagController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Tag\TagService;

class TagController extends Controller
{
    protected $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    // Lấy danh sách tất cả các tag
    public function index()
    {
        $tags = $this->tagService->getAllTags();
        return response()->json($tags); // Trả về dữ liệu JSON
    }

    // Lấy thông tin chi tiết một tag
    public function show($id)
    {
        $tag = $this->tagService->getTagById($id);
        return response()->json($tag); // Trả về dữ liệu JSON
    }

    // Tạo mới một tag
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $tag = $this->tagService->createTag($data);
        return response()->json($tag, 201); // Trả về dữ liệu JSON với mã trạng thái 201 (đã tạo thành công)
    }

    // Cập nhật tag
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag = $this->tagService->updateTag($id, $data);
        return response()->json($tag); // Trả về dữ liệu JSON
    }

    // Xóa tag
    public function destroy($id)
    {
        $this->tagService->deleteTag($id);
        return response()->json(['message' => 'Tag deleted successfully']); // Trả về thông báo thành công dưới dạng JSON
    }
}
