<?php

namespace App\Imports;

use App\Models\StudentData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StudentDataImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $admission_no = intval($row[3]);
        $roll_no = intval($row[4]);

        $date = explode("/",$row[7]);
        $dob = $date[2].'-'.$date[1].'-'.$date[0];
        
        $data = StudentData::where([['admission_no', '=', $admission_no],['roll_no', '=', $roll_no]])->first();
        
        if (empty($data)) {
            return new StudentData([
                'name'          => $row[0],
                'class'         => $row[1], 
                'section'       => $row[2], 
                'admission_no'  => $admission_no, 
                'roll_no'       => $roll_no, 
                'father_name'   => $row[5], 
                'mother_name'   => $row[6], 
                'dob'           => $dob, 
                'mobile'        => intval($row[8])
            ]);
        }        
    }

    public function startRow(): int
    {
        return 2;
    }
}
