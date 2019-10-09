<?php

namespace App\Exports;

use App\Listener;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ListenersExport implements FromCollection, WithHeadings, WithStrictNullComparison
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Listener::all();
      return Listener::select(
        'firstName', 
        'lastName', 
        'DOB', 
        'email', 
        'phone', 
        'suburb', 
        'participations',
        'additionalInfo',
        'created_at',
        'updated_at'
      )->get();
    }

    public function headings(): array{
      return [
        'First Name',
        'Last Name',
        'DOB',
        'Email',
        'Phone',
        'Suburb',
        'Participations',
        'Additional Info',
        'Created at',
        'Updated at'
      ];
    }
}
