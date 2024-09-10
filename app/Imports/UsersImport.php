<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = new User([
            'name'     => $row['nama'],
            'email'    => $row['email'], 
            'password' => Hash::make($row['password']),
            'ic'       => $row['ic'],
            'jawatan'  => $row['jawatan'],
            'bahagian' => $row['bahagian'],
            'ext'      => $row['telefon'],
            'role_id'  => $row['role_id'],
        ]);

        $user->save();

        // Assuming you have a method to attach role to a user
        $user->attachRole($row['role_id']);

        return $user;
    }
}

