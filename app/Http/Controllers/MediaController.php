<?php
// app/Http/Controllers/MediaController.php
namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function store(Request $request, Employee $employee)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('file');
        $path = $file->store('media/' . $employee->id, 'public');

        Media::create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
            'type' => $file->getMimeType(),
            'employee_id' => $employee->id,
        ]);

        return response()->json(['success' => true]);
    }

    public function destroy(Media $media)
    {
        Storage::disk('public')->delete($media->path);
        $media->delete();
        return back()->with('success', 'File deleted');
    }
}