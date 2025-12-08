<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function storeAddress(Request $request){
        $request->validate([
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address_line' => 'required|string|max:500',
            'city' => 'required|exists:cities,city_id',
            'province' => 'required|exists:provinces,province_id',
            'zip_code' => 'required|string|max:10',
        ]);

        Address::create([
            'user_id' => auth()->id(),
            'label' => $request->label,
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
        ]);

        return back()->with('success', 'Alamat berhasil disimpan.');
    }


    public function editAddress(Request $request, $id){
        $address = Address::where('user_id', auth()->user()->id)->where('id', $id)->firstOrFail();

        $request->validate([
            'label' => 'required|string|max:255',
            'recipient_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address_line' => 'required|string|max:500',
            'city' => 'required|exists:cities,city_id',
            'province' => 'required|exists:provinces,province_id',
            'zip_code' => 'required|string|max:10',
        ]);

        $address->update([
            'label' => $request->label,
            'recipient_name' => $request->recipient_name,
            'phone_number' => $request->phone_number,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'province' => $request->province,
            'zip_code' => $request->zip_code,
        ]);

        return redirect()->back()->with('success', 'Alamat berhasil diperbarui.');
    }
    
    public function setDefaultAddress(Request $request){
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
        ]);

        $address = Address::where('user_id', auth()->user()->id)->where('id', $request->address_id)->firstOrFail();

        Address::where('user_id', auth()->user()->id)->update(['is_default' => false]);

        $address->is_default = true;
        $address->save();

        return redirect()->back()->with('success', 'Alamat default berhasil diatur.');
    }

    public function profile(){
        return view('user.profile.index');
    }

    public function update(Request $request){
        $user = auth()->user();

        $validated = $request->validate([
            'name'   => ['nullable', 'string', 'max:255'],
            'phone'  => ['nullable', 'string', 'max:20'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $updateData = [];
        
        if (!empty($validated['name'])) {
            $updateData['name'] = $validated['name'];
        }
        
        if (!empty($validated['phone'])) {
            $updateData['phone_number'] = $validated['phone'];
        }

        if ($request->hasFile('avatar')) {
            if ($user->avatar && !str_contains($user->avatar, 'ui-avatars.com')) {
                $oldPath = public_path($user->avatar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            $extension = $request->avatar->extension();
            $filename = 'user-profile_' . now()->format('YmdHis') . '.' . $extension;
            $request->avatar->move(public_path('images/profile/user'), $filename);
            $updateData['avatar'] = 'images/profile/user/' . $filename;
        }

        if (empty($updateData)) {
            return back()->with('success', 'Tidak ada perubahan yang dilakukan.');
        }
        $user->update($updateData);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}
