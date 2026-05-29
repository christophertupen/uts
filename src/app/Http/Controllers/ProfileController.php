<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Update profile photo
     */
    public function updatePhoto(Request $request)
    {
        try {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120'
            ]);

            // Get the first profile (assuming single profile system)
            $profile = Profile::first();
            
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile tidak ditemukan'
                ], 404);
            }

            // Delete old photo if exists
            if ($profile->photo && Storage::exists($profile->photo)) {
                Storage::delete($profile->photo);
            }

            // Store new photo
            $path = $request->file('photo')->store('profile', 'public');

            // Update profile
            $profile->update(['photo' => $path]);

            return response()->json([
                'success' => true,
                'message' => 'Foto profile berhasil diubah',
                'photo_url' => Storage::url($path)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update profile data
     */
    public function update(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'nullable|string|max:255',
                'role' => 'nullable|string|max:255',
                'bio' => 'nullable|string',
                'email' => 'nullable|email',
                'phone' => 'nullable|string',
                'github_url' => 'nullable|url',
                'linkedin_url' => 'nullable|url',
                'whatsapp_url' => 'nullable|string',
            ]);

            $profile = Profile::first();
            
            if (!$profile) {
                return response()->json([
                    'success' => false,
                    'message' => 'Profile tidak ditemukan'
                ], 404);
            }

            $profile->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Profile berhasil diperbarui',
                'data' => $profile
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
