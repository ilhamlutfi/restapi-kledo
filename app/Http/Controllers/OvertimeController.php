<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use App\Services\OvertimeService;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\OvertimeRequest;
use App\Http\Requests\CalculateRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OvertimeController extends Controller
{
    protected $overtimeService;

    public function __construct(OvertimeService $overtimeService)
    {
        $this->OvertimeService = $overtimeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $overtimes = Overtime::latest()->get();

        return ResponseFormatter::success($overtimes, 'Overtimes List');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OvertimeRequest $request)
    {
        $data = $request->validated();
        $newOvertime =  $this->OvertimeService->create($data);

        return ResponseFormatter::success($newOvertime, 'Success stored');
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
            $newOvertime =  $this->OvertimeService->show($id);
        } catch (ModelNotFoundException $ex) {
            return ResponseFormatter::error(null, 'Data not found', null, ResponseFormatter::HTTPCODE_ERROR_RESOURCENOTFOUND);
        }
        return ResponseFormatter::success($newOvertime, '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OvertimeRequest $request, Overtime $overtime)
    {
        $data = $request->validated();
        $newOvertime =  $this->OvertimeService->update($data, $overtime->id);

        return ResponseFormatter::success($newOvertime, 'Success updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newOvertime =  $this->OvertimeService->delete($id);

        return ResponseFormatter::success($newOvertime, 'Success deleted');
    }

    public function calculate(CalculateRequest $request)
    {
        $data = $request->validated();
        $newOvertime =  $this->OvertimeService->calc($data);

        return $newOvertime;
    }
}
