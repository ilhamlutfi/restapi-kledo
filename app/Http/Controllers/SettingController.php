<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SettingService;
use App\Helpers\ResponseFormatter;
use App\Http\Requests\SettingRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $setting = Setting::latest()->get();

        return ResponseFormatter::success($setting);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingRequest $request)
    {
        $data = $request->validated();
        $newSetting =  $this->settingService->create($data);

        return ResponseFormatter::success($newSetting, 'Success stored');
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
            $newSetting =  $this->settingService->show($id);
        } catch (ModelNotFoundException $ex) {
            return ResponseFormatter::error(null, 'Data not found', null, ResponseFormatter::HTTPCODE_ERROR_RESOURCENOTFOUND);
        }
        return ResponseFormatter::success($newSetting, '');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, $id)
    {
        $data = $request->validated();
        $newSetting =  $this->settingService->update($data, $id);

        return ResponseFormatter::success($newSetting, 'Success updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $newSetting =  $this->settingService->delete($id);

        return ResponseFormatter::success($newSetting, 'Success deleted');
    }
}
