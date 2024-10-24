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
        file_put_contents($filePath, json_encode($customers, JSON_PRETTY_PRINT));
    }
}

