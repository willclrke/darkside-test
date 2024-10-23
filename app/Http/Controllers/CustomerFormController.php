<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Models\CustomerFormModel; // Import model

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
        
        try {
            
            // Retrieve existing customers from the model
            $existingCustomers = CustomerFormModel::allCustomers();
            $nameExists = false;

            // Check for existing customer by name
            foreach ($existingCustomers as &$entry) {
                if ($entry['name'] === $validatedData['name']) {
                    // Update the existing entry with new data
                    $entry = array_merge($entry, $validatedData);
                    $nameExists = true;
                    break; // Exit loop if entry found
                }
            }

            // Prepare success message
            $message = $nameExists ? 'Existing details updated successfully!' : 'New details added successfully!';
        
            // If no existing entry was found, just go ahead and add the new data
            if (!$nameExists) {
                $existingCustomers[] = $validatedData;
            }
            
            // Send the updated list of customers back to the model for saving to file
            CustomerFormModel::saveCustomers($existingCustomers);

            // Return success response
            return response()->json(['success' => $message]);

        } catch (\Exception $e) {
            
            // Log the error message
            Log::error('Error writing to file: ' . $e->getMessage());

            // Return an error response with 500
            return response()->json(['error' => 'There was a problem saving your data. Please try again later.'], 500);
            
        }
        

    }
}
