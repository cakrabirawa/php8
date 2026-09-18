<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RobotErrorScreenshot;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RobotErrorScreenshotController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_robot' => 'required|string|max:50',
            'file_name' => 'nullable|string|max:255',
            'file' => 'nullable|file|image|mimes:jpg,jpeg,png,bmp,gif,webp',
        ]);

        $fileName = $validated['file_name'] ?? null;
        $uploadedFile = $request->file('file');

        if ($uploadedFile) {
            $originalName = $uploadedFile->getClientOriginalName();
            $extension = $uploadedFile->getClientOriginalExtension();
            $safeName = Str::slug(pathinfo($originalName, PATHINFO_FILENAME), '-') ?: 'robot-error';
            $fileName = $fileName ?? $safeName . '-' . now()->format('YmdHis') . '.' . $extension;

            $path = $uploadedFile->storeAs('robot-error-screenshots', $fileName, 'public');

            $fileName = basename($path);
        }

        if (empty($fileName) && ! $uploadedFile) {
            return response()->json([
                'success' => false,
                'message' => 'File screenshot wajib diupload atau nama file wajib disediakan.',
            ], 422);
        }

        $data = RobotErrorScreenshot::create([
            'nama_robot' => $validated['nama_robot'],
            'file_name' => $fileName,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Screenshot robot berhasil disimpan.',
            'data' => [
                'id' => $data->id,
                'nama_robot' => $data->nama_robot,
                'file_name' => $data->file_name,
                'file_url' => $data->file_name ? route('robot.error_screenshot', ['filename' => $data->file_name]) : null,
            ],
        ], 201);
    }
}
