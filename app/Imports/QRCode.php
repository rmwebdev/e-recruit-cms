<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromCollection;
class QRCode implements FromCollection
{
    /**
    * @param Collection $collection
    */
    // public function collection(Collection $collection)
    // {
    //     //
    // }


     public function collection()
    {   
        return SalesOrder::all();
    }


    //  public function model(array $row)
    // {


    //     // print_r($row);
    //     // exit();
    //     return new Location([
    //         // 
    //        'teslo'=>$row['Nopol']
            
    //     ]);
    // }


}
