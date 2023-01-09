<?php

namespace App\Http\Resources;

use App\Helpers\CountTime;
use App\Http\Resources\OvertimeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'salary' => $this->salary,
            'overtimes' => OvertimeResource::collection($this->Overtimes),
            // 'overtime_duration_total' => $this->Overtimes->pluck('overtime_duration')
            // 'overtime_duration_total' => $this->getTimeTotal($this->Overtimes->values('time_started'), $this->Overtimes->values('time_ended'))
        ];
    }

    public function getTimeTotal($awal, $akhir)
    {
        $waktu_awal     = strtotime($awal);
        $waktu_akhir    = strtotime($akhir);

        $diff    = $waktu_akhir - $waktu_awal;
        $jam    = floor($diff / (60 * 60));
        $menit    = $diff - $jam * (60 * 60);

        $result = $jam .  ' jam ' .  floor($menit / 60) . ' menit';

        return $result;
    }
}
