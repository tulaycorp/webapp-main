<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Get all settings.
     */
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return response()->json($settings);
    }

    /**
     * Update a specific setting.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string',
            'value' => 'nullable|string',
        ]);

        $setting = Setting::updateOrCreate(
            ['key' => $validated['key']],
            ['value' => $validated['value']]
        );

        return response()->json($setting);
    }
    /**
     * Upload a setting image to Cloudflare R2.
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,gif,webp|max:5120', // 5MB max
            'setting_key' => 'required|string',
        ]);

        $file = $request->file('image');
        $settingKey = $request->input('setting_key');
        
        // Generate a unique filename to prevent caching issues
        // e.g., settings/sold_out_image_home_UUID.jpg
        $extension = $file->getClientOriginalExtension();
        $uuid = Str::uuid();
        $filename = "{$settingKey}_{$uuid}.{$extension}";
        $path = "settings/{$filename}";

        try {
            // Upload to R2
            $disk = \Illuminate\Support\Facades\Storage::disk('r2');
            $disk->put($path, file_get_contents($file), 'public');

            // Get the public URL
            $url = config('filesystems.disks.r2.url') . '/' . $path;

            // Automatically update the setting
            $setting = Setting::updateOrCreate(
                ['key' => $settingKey],
                ['value' => $url]
            );

            return response()->json([
                'success' => true,
                'message' => 'Image uploaded and setting updated successfully',
                'data' => [
                    'url' => $url,
                    'path' => $path,
                    'key' => $settingKey
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to upload image: ' . $e->getMessage(),
            ], 500);
        }
    }
}
