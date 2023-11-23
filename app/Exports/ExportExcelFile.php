<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class ExportExcelFile implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            ['Name', 'E-mail','Manager Name','Manager Department','Manager Number','Manager E-mail', 'Coupon type','Number of coupons','Note'],
        ]);
    }
}
