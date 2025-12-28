<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MembersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Member::all();
    }

    public function headings(): array
    {
        return [
            '#',
            'Member Number',
            'Name',
            'Email',
            'Phone Number',
            'Date of Joining',
            'Profession',
            'Race',
            'Minimum Spent',
            'Contact Details',
            'Status',
            'Member Type',
            'Date of Birth',
            'Gender',
            'Created At',
            'Updated At',
        ];
    }
}
