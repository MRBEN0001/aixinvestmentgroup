<?php
namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    private $mappings;

    public function __construct(array $mappings)
    {
        // Ensure required fields have mappings
        $requiredFields = ['name', 'email', 'age'];
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $mappings)) {
                throw new \Exception("Missing mapping for field: $field");
            }
        }

        $this->mappings = $mappings;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $usernames = [
            'techie_bob',
            'jane_doe21',
            'coding_master',
            'wanderlust_88',
            'samurai_steve',
            'pixel_pioneer',
            'astro_hero',
            'sunny_skywalker',
            'hiking_jack',
            'geeky_guru',
            'ninja_kate',
            'swift_sailor',
            'rusty_rider',
            'silent_rebel',
            'cosmic_dreamer',
        ];

        // Generate a unique username
        do {
            $username = $usernames[array_rand($usernames)];
        } while (\App\Models\User::where('username', $username)->exists());

        // Ensure you have valid mappings and handle missing mappings
        $nameIndex = array_key_exists('name', $this->mappings) ? $this->mappings['name'] : null;
        $emailIndex = array_key_exists('email', $this->mappings) ? $this->mappings['email'] : null;
        $ageIndex = array_key_exists('age', $this->mappings) ? $this->mappings['age'] : null;

        // Check if any required mapping is missing
        if (is_null($nameIndex) || is_null($emailIndex) || is_null($ageIndex)) {
            throw new \Exception("Missing one or more required field mappings.");
        }

        // Retrieve actual values from the row based on the mappings
        $name = isset($row[$nameIndex]) && !empty($row[$nameIndex]) ? $row[$nameIndex] : 'Default Name';
        $email = isset($row[$emailIndex]) ? $row[$emailIndex] : null;
        $age = isset($row[$ageIndex]) ? $row[$ageIndex] : null;

        // Ensure that name, email, and age are not null
        if (is_null($name) || is_null($email) || is_null($age)) {
            // Skip the row if any required fields are missing
            return null;
        }

        // Check if email already exists in the database
        if (\App\Models\User::where('email', $email)->exists()) {
            // Skip this row if the email already exists
            return null;
        }

        // Create and return the user model
        return new User([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => bcrypt('default_password'),
        ]);
    }
}