<?php

namespace App\Repositories\HC\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository
{
    function create(string $table, int $id, $data) {
        $result = DB::table($table)->create($data);

        return $result;
    }

    function udpate(string $table, int $id, $data) {
        $result = DB::table($table)
                ->where('id', $id)
                ->update($data);

        return $result;
    }
}
