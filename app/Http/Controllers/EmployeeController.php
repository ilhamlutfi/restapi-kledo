<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()->get();

        return ResponseFormatter::success($employees, 'Employees List');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $newEmployee =  $this->employeeService->create($data);

        return ResponseFormatter::success($newEmployee, 'Success stored');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $newEmployee =  $this->employeeService->show($id);
        } catch (ModelNotFoundException $ex) {
            return ResponseFormatter::error(null, 'Data not found', null, ResponseFormatter::HTTPCODE_ERROR_RESOURCENOTFOUND);
        }
        return ResponseFormatter::success($newEmployee, '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        $newEmployee =  $this->employeeService->update($data, $employee->id);

        return ResponseFormatter::success($newEmployee, 'Success updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newEmployee =  $this->employeeService->delete($id);

        return ResponseFormatter::success($newEmployee, 'Success deleted');
    }
}
