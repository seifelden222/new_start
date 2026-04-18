<?php

namespace App\Http\Controllers;

use App\Models\CharityCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CharityCaseController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'category' => ['required', 'string'],
            'status' => ['required', 'in:عاجلة,نشطة,مكتملة,معلقة'],
            'target_amount' => ['required', 'integer', 'min:1'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = $request->only(['title', 'description', 'category', 'status', 'target_amount']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('cases', 'public');
        }

        CharityCase::create($data);

        return redirect()->route('casemanage')->with('success', 'تم إضافة الحالة بنجاح');
    }

    public function update(Request $request, CharityCase $charityCase): RedirectResponse
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'status' => ['required', 'in:عاجلة,نشطة,مكتملة,معلقة'],
            'target_amount' => ['required', 'integer', 'min:1'],
        ]);

        $charityCase->update($request->only(['title', 'description', 'category', 'status', 'target_amount']));

        return redirect()->route('casemanage')->with('success', 'تم تحديث الحالة');
    }

    public function destroy(CharityCase $charityCase): RedirectResponse
    {
        $charityCase->delete();

        return redirect()->route('casemanage')->with('success', 'تم حذف الحالة');
    }
}
