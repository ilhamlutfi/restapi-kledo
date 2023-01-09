<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class OvertimeResource extends JsonResource
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
            'date' => $this->date,
            'time_started' => date('H:i', strtotime($this->time_started)),
            'time_ended' => date('H:i', strtotime($this->time_ended)),
            'overtime_duration' => $this->getTimeRangeString($this->time_started, $this->time_ended)
        ];
    }

    public function getTimeRangeString($awal, $akhir)
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
