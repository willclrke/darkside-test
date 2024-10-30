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
            'phone' => [
                'required',
                'regex:/^(?:\+44|0)7\d{9}$|^(?:\+44|0)1\d{3} \d{3} \d{3}$|^(?:\+44|0)2\d{3} \d{3} \d{4}$/',
                'max:14', // Adjust max length for international formats
            ],
            'address' => 'required|min:10|max:255', // Could add more in depth address validation here using a library/dependency
        ]);
        
        try {

            // Call the model to update existing or create new customer entry
            $message = CustomerFormModel::updateOrCreateCustomer($validatedData);
            
            // Return a response indicating success, along with the message
            return response()->json(['success' => $message], 200);

        } catch (\Exception $e) {

            // Log the error message along with the request data for better debugging
            Log::error('Error processing customer data: ' . $e->getMessage(), ['request' => $request->all()]);
            
            // Return a JSON response indicating an error occurred, with a generic message
            return response()->json(['error' => 'There was a problem saving your data. Please try again later.'], 500);

        }
               
    }
}
