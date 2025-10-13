<?php

namespace App\Http\Controllers\Deck;

use App\Http\Controllers\Controller;
use App\Models\Pulse;
use App\Models\PulseMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PulseMediaController extends Controller
{
    public function index(Pulse $pulse)
    {

    }

    public function store(Request $request, Pulse $pulse)
    {
        $data = $request->validate([
            'file' => ['required', 'file'],
        ]);

        $folder = 'uploads/'.config('nerva.pulse.upload_media_directory').'/'.$pulse->id;
        $filename = Str::uuid().'.'.$request->file('file')->getClientOriginalExtension();

        $path = $data['file']->storeAs($folder, $filename, [
            'disk' => config('filesystems.default'),
        ]);

        $pulse->medias()->create([
            'type' => explode('/', $data['file']->getMimeType())[0],
            'filename' => $filename,
            'path' => $path,
            'mime_type' => $data['file']->getMimeType(),
            'disk' => config('filesystems.default'),
        ]);

        return back();
    }

    public function destroy(Pulse $pulse, PulseMedia $media)
    {
        dd($media);
    }
}
