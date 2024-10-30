<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerFormModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    /*
    Retrieve all customers from the JSON file, and return an array of customer data.
    */
    public static function allCustomers()
    {
        $filePath = storage_path('app/data/CustomerData.json');
        
        // Check if the file exists
        if (file_exists($filePath)) {
            // Read the file contents and decode the JSON into an array
            return json_decode(file_get_contents($filePath), true);
        }
        // Return empty array if it doesn't
        return [];
    }

    /*
    Save the data to JSON file
    */
    public static function saveCustomers($customers)
    {
        // Define the path to the JSON file
        $filePath = storage_path('app/data/CustomerData.json');
        
        // Encode the customers array into JSON and save it to the file
        if (file_put_contents($filePath, json_encode($customers, JSON_PRETTY_PRINT)) === false) {
            throw new \Exception('Unable to save customers to file.');
        }
    }

    /**
     * Update existing customer or create a new one.
     */
    public static function updateOrCreateCustomer(array $data)
    {
        // Retrieve all existing customers from the JSON file
        $customers = self::allCustomers();
        $nameExists = false;

        // Loop through the existing customers to find a match by name
        foreach ($customers as &$entry) {
            // If a customer with the same name is found
            if ($entry['name'] === $data['name']) {
                // Update existing entry with new data
                $entry = array_merge($entry, $data);
                $nameExists = true;
                break;
            }
        }

        // If name does not already exist, add new customer
        if (!$nameExists) {
            // Append the new customer data to the array
            $customers[] = $data; 
        }

        // Save the updated list of customers back to the JSON file
        self::saveCustomers($customers);

        // Return a success message indicating whether an update or new addition was made
        return $nameExists ? 'Existing details updated successfully!' : 'New details added successfully!';
    }
}

