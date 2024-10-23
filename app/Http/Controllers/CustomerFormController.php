<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Import the File facade
use Illuminate\Support\Facades\Log; // Import the Log facade

class CustomerFormController extends Controller
{
    public function submit(Request $request)
    {
        // Capture and validate input
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|min_digits:11|max_digits:11', // Could add more in depth phone/tel validation here using a library/dependency
            'address' => 'required|min:10|max:255', // Could add more in depth address validation here using a library/dependency
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

            // Check if an entry with the same name already exists
            $nameExists = false;
            foreach ($existingData as &$entry) {
                if ($entry['name'] === $validatedData['name']) {
                    // Update the existing entry with new data
                    $entry = array_merge($entry, $validatedData);
                    $nameExists = true;
                    break; // Exit the loop once we find the entry
                }
            }

            // Prepare success message
            $message = '';

            // If no existing entry was found, add the new data
            if (!$nameExists) {
                $existingData[] = $validatedData;
                $message = 'New details added successfully!';
            } else {
                $message = 'Existing details updated successfully!';
            }

            // Write data to file in JSON format
            File::put($filePath, json_encode($existingData, JSON_PRETTY_PRINT));

            return response()->json(['success' => $message]);

        } catch (\Exception $e) {
            
            // Log the error message
            Log::error('Error writing to file: ' . $e->getMessage());

            // Return an error response
            return response()->json(['error' => 'There was a problem saving your data. Please try again later.'], 500);
            
        }
        

    }
}
