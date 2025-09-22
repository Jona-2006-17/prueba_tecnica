<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $rows = 0;

    public function model(array $row)
    {
        $this->rows++;

        return new User([
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'dni' => $row['dni'],
            'password' => $row['password'],
        ]);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
 
}

