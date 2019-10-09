<?php

namespace App\Imports;

use App\Listener;
use Maatwebsite\Excel\Concerns\ToModel;

class ListenersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if ($row[1] != "FIRST NAME" || $row[2] != "LAST NAME") {
        return new Listener([
        'firstName' => $row[1],
        'lastName' => $row[2],
        'phone' => $row[3],
        'suburb' => $row[4]
      ]);
      }
    }
}
