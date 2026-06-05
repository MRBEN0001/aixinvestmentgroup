<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BankSeeder extends Seeder
{
    public function run()
    {
        $bankNames = [
            'JPMorgan Chase & Co.',
            'Bank of America',
            'HSBC Holdings plc',
            'Wells Fargo & Company',
            'Citigroup Inc.',
            'Mitsubishi UFJ Financial Group',
            'BNP Paribas',
            'Bank of China',
            'Royal Bank of Canada',
            'Barclays plc',
            'Geepay',
            'Gray',
            'Wise', // TransferWise
            'Ally Financial',
            'Capital One',
            'ING Group',
            'Société Générale',
            'Standard Chartered Bank',
            'UBS Group',
            'American Express',
            'Citizens Financial Group',
            'Deutsche Bank',
            'Commerzbank',
            'Goldman Sachs',
            'Morgan Stanley',
            'BNY Mellon',
            'Credit Suisse',
            'PNC Financial Services',
            'TD Bank',
            'Fifth Third Bank',
            'State Street Corporation',
            'BB&T Corporation',
            'SunTrust Banks',
            'Santander Bank',
            'Banco Santander',
            'BBVA Compass',
            'Regions Financial Corporation',
            'HSBC Bank USA',
            'Discover Financial',
            'KeyBank',
            'Northern Trust',
            'Bank of the West',
            'BNZ Bank',
            'Westpac Banking Corporation',
            'Suncorp Group',
            'Macquarie Group',
            'Bank of New Zealand',
            'Kiwibank',
            'ASB Bank',
            'Bank of Montreal',
            'Canadian Imperial Bank of Commerce (CIBC)',
            'Scotiabank',
            'National Bank of Canada',
            'Desjardins Group',
            'Intesa Sanpaolo',
            'UniCredit',
            'Banca Monte dei Paschi di Siena',
            'Bank of Tokyo-Mitsubishi UFJ',
            'Sumitomo Mitsui Financial Group',
            'Resona Holdings',
            'Mizuho Financial Group',
            'Mitsubishi UFJ Trust and Banking Corporation',
            'Nomura Holdings',
            // Add more bank names as needed
        ];

        // Insert each bank name into the database
        foreach ($bankNames as $name) {
            Bank::create([
                'name' => $name,
            ]);
        }
    }
}
