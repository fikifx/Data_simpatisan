<?php

// File: App/Exports/SimpatisanExport.php

namespace App\Exports;

use App\Models\Simpatisan;
use Maatwebsite\Excel\Concerns\FromCollection;

class SimpatisanExport implements FromCollection
{
    public function collection()
    {
        return Simpatisan::all();
    }
}
