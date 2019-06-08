<?php

namespace App\Http\Controllers;

use App\VisaStatus;

use Illuminate\Http\Request;

class VisaStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('visa_file_upload');
    }

    public function storeData(Request $request)
    {
        $upload = $request->file('upload-visa-file');
        $filePath = $upload->getRealPath();
        $file = fopen($filePath, 'r'); // 'r' - read mode

        $header = fgetcsv($file);

        // getting header 
        $escaptdHeader = [];
        foreach ($header as $key => $value) {
            $lowerCaseHeader = strtolower($value);


            $escapedItem = preg_replace('/[^a-z]/', '', $lowerCaseHeader);
            array_push($escaptdHeader, $escapedItem);
        }

        // getting the values columns
        while ($columns = fgetcsv($file)) {
            // if ($columns[0] === "Brno") {
            //     continue;
            // }
            foreach ($columns as $key => &$value) {
                $value = preg_replace('/[^ a-zA-Z0-9 *]/', '', $value);
            }
            $data = array_combine($escaptdHeader, $columns);

            foreach ($data as $key => &$value) {
                $value = ($key == 'visa') ? (string)$value : (string)$value;
            }
            $visa = $data['visa'];

            $budget = VisaStatus::create(['visa' => $visa]);
            $budget->visa = $visa;
            $budget->save();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
