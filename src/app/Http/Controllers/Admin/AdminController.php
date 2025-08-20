<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Story;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Возвращает список историй для модераций
     * При указании get параметра status можно получить истории с определенным статусом
     * ?status=pending - на модерации
     * ?status=approved - одобрен
     * ?status=rejected - отклонен
     *
     * Если параметр не указан, то показываются все истории.
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = Story::with('user', 'tags');

        if ($request->has('status') && in_array($request->status, [Story::STATUS_PENDING, Story::STATUS_PUBLISHED, Story::STATUS_REJECTED])) {
            $query = $query->where('status', $request->status);
        }

        $stories = $query->latest()->paginate(10);

        return view('admin.index', compact('stories'));
    }

    /**
     * Меняет статус истории на одобрено
     * @param int $id id истории
     * @return RedirectResponse
     */
    public function approve(int $id): RedirectResponse
    {
        $story = Story::findOrFail($id);

        $story->update(['status' => Story::STATUS_PUBLISHED]);

        return back()->with('success', 'История одобрена успешно');
    }

    /**
     * Меняет статус истории на отклонено
     * @param int $id id истории
     * @return RedirectResponse
     */
    public function reject(int $id): RedirectResponse
    {
        $story = Story::findOrFail($id);
        $story->update(['status' => Story::STATUS_REJECTED]);

        return back()->with('success', 'История отклонена успешно');
    }
}
