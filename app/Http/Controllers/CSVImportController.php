<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CsvImport;



class CSVImportController extends Controller
{
    public function import(Request $request)
    {
        $file = $request->file('csv_file');
        $handle = fopen($file->getPathname(), 'r');
        $header = fgetcsv($handle, 4096);

        while (($line = fgetcsv($handle, 4096)) != false) {
            $row = array_combine($header, $line);
            $csvData = new CsvImport;
            $csvData->name = $row[$header[0]];
            $csvData->Contact_number = $row[$header[0]];
            $csvData->Jersry_Size = $row[$header[1]];
            $csvData->Jersey_number = $row[$header[2]];
            $csvData->Jersey_type = $row[$header[3]];
            $csvData->any_comment = $row[$header[4]];
            $csvData->save();
        }
        return redirect()->back();
        fclose($handle);

    }
}
