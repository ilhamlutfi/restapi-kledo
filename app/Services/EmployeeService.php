<?php

namespace App\Services;
use App\Models\Employee;

class EmployeeService
{
    public function create($data)
    {
        $newEmployee = Employee::create([
            'name'       => $data['name'],
            'salary'     => $data['salary'],
        ]);

        return $newEmployee;
    }

    public function update($data, $id)
    {
        Employee::where('id', $id)->update($data);
        $newEmployee = Employee::find($id);

        return $newEmployee;
    }

    public function show($id)
    {
        $newEmployee = Employee::findOrFail($id);

        return $newEmployee;
    }

    public function delete($id)
    {
        return Employee::find($id)->delete();
    }

}
