<?php

namespace App\Http\Controllers;

use App\Models\StudentData;
use Illuminate\Http\Request;
use App\Imports\StudentDataImport;
use Redirect;
use DataTables;

class ExcelController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function importView() {
       return view('excel.index');
    }

    public function importExcel(Request $request) {

        if ($request->import_file) {
            $file = $request->import_file;        
            $type = $file->getClientMimeType();

            if ($type == 'application/vnd.ms-excel') {
                \Excel::import(new StudentDataImport,$file);

                $status = 'success';
                $message = 'Your file is imported successfully in database.';
            }else{
                $status = 'error';
                $message = 'Only Excel can be uploaded.';
            }      
        }else{
            $status = 'error';
            $message = 'File not selected.';
        }
           
        return back()->with($status, $message);
    }

    public function studentView(){
        $class = StudentData::select('class')->groupBy('class')->get();
        $section = StudentData::select('section')->groupBy('section')->get();

        $data = [
            'class' => $class, 
            'section' => $section, 
        ];

        return view('student.index')->with('data',$data);
    }

    public function studentList(Request $request)
    {
        $classSel = $request->selClass;
        $selSection = $request->selSection;
    
        $student = StudentData::where([['class','=',$classSel],['section','=',$selSection]])->orderBy('id','ASC')->get();        

        if ($request->ajax()) {           
            $data = Datatables::of($student)->addIndexColumn()->make(true);            
            return $data;
        }
    }
}
