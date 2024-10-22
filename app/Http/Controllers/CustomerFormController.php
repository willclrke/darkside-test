<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Import the File facade

class CustomerFormController extends Controller
{
    public function submit(Request $request)
    {
        // Capture and validate input
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|min_digits:11|max_digits:11',
            'address' => 'required|min:10|max:255',
        ]);
        
        // Prepare data for writing to file
        $dataToWrite = implode(', ', $validatedData) . "\n";

        // Define file path
        $filePath = storage_path('app/data/CustomerData.json'); // Define file path

        try {
            // Check if file already exists, if it does, read existing content and decode into an array
            $existingData = [];
            if (File::exists($filePath)) {
                $existingData = json_decode(File::get($filePath), true);
            }

            // Append new data
            $existingData[] = $validatedData;

            // Write data to file in JSON format
            File::put($filePath, json_encode($existingData, JSON_PRETTY_PRINT));

            error_log('Success!');

            return back()->with('success', 'Thank you!');

        } catch (\Exception $e) {
            
            // Log the error message
            Log::error('Error writing to file: ' . $e->getMessage());

            // Return an error response
            return back()->withErrors(['file' => 'There was a problem saving your data. Please try again later.']);
            
        }
        

    }
}
