<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DrugController extends Controller
{
    public function createDrug(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:500',
            'dosis' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'type' => 'required|string|max:255',
        ]);

        $image = $request->file('image');
        $image_name = now()->format('YmdHis') . '_' . $image->getClientOriginalName();
        $image->move(public_path('images/drugs'), $image_name);

        $drug = Drug::create([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'image' => $image_name,
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
            'dosis' => $request->input('dosis'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
            'type' => $request->input('type'),
        ]);

        return redirect()->back()->with('success', 'Drug created successfully!');
    }

    public function editDrug(Request $request, $id)
    {
        $drug = Drug::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|nullable|image|max:2048',
            'description' => 'sometimes|nullable|string',
            'short_description' => 'sometimes|nullable|string|max:500',
            'dosis' => 'sometimes|nullable|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'type' => 'sometimes|required|string|max:255',
        ]);

        $drug->update($request->only([
            'name',
            'category',
            'description',
            'short_description',
            'dosis',
            'price',
            'stock',
            'type',
        ]));

        if ($request->hasFile('image')) {
            File::delete(public_path('images/drugs/' . $drug->image));
            $image = $request->file('image');
            $image_name = now()->format('YmdHis') . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/drugs'), $image_name);
            $drug->image = $image_name;
            $drug->save();
        }

        return redirect()->back()->with('success', 'Drug updated successfully!');
    }

    public function deleteDrug($id)
    {
        $drug = Drug::findOrFail($id);
        $drug->is_active = false;
        $drug->save();

        return redirect()->back()->with('success', 'Drug deleted successfully!');
    }
}
