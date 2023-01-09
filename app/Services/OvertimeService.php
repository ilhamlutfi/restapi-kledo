<?php

namespace App\Services;

use App\Models\Employee;
use App\Models\Overtime;
use Illuminate\Support\Carbon;
use App\Http\Resources\EmployeeResource;

class OvertimeService
{
    public function create($data)
    {
        $newOvertime = Overtime::create([
            'employee_id'   => $data['employee_id'],
            'date'          => $data['date'],
            'time_started'  => $data['time_started'],
            'time_ended'    => $data['time_ended'],
        ]);

        return $newOvertime;
    }

    public function update($data, $id)
    {
        Overtime::where('id', $id)->update($data);
        $newOvertime = Overtime::find($id);

        return $newOvertime;
    }

    public function show($id)
    {
        $newOvertime = Overtime::findOrFail($id);

        return $newOvertime;
    }

    public function delete($id)
    {
        return Overtime::find($id)->delete();
    }

    public function calc($data)
    {
        $month = $data['month'];

        $overtime_calculations = Employee::with(['Overtimes' => function ($query) use ($month) {
            $query->whereMonth('date', Carbon::parse($month)->month);
        }])->get();

        $overtimeResult = EmployeeResource::collection($overtime_calculations);
        // $overtimeResult = new EmployeeResource($overtime_calculations);

        return $overtimeResult;
    }
}
