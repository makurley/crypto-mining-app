<?php
// app/Http/Controllers/LogoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoController extends Controller
{
    public function uploadLogo(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the file upload
        $file = $request->file('logo');

        // Set the filename to ui.jpg (ensure the file is saved with this exact name)
        $filename = 'ui.jpg';

        // Move the uploaded file to the logo directory with the specific filename
        $file->move(public_path('logo'), $filename);

        // Return a success message
        return back()->with('success', 'Logo uploaded successfully');
    }
}
