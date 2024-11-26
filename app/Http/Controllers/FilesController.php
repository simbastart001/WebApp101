<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Log;
use App\Exports\LogsExport;
use App\Imports\LogsImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class FilesController extends Controller
{

    public function import(Request $request) 
    {
        try{

            // $request->validate([
            //     'file' => 'required|mimes:xlsx,csv'
            // ]);

            Excel::import(new LogsImport, $request->file('file'));
            return redirect()->route('uploads')->with('success', 'Logs imported successfully.');
        }catch(\Exception $ex){
            Log::info($ex);
            return redirect()->route('home')->with('error', 'An error occurred: ' . $e->getMessage());
        }
        
    }

    public function export() 
    {
        return Excel::download(new LogsExport, 'logs.pdf');
    }

    public function showUploads()
    {
        // Fetch logs from the database
        $logs = Log::all();

        // Return the view with logs data
        return view('uploads', compact('logs'));
    }

     // Method to display the edit form with log data
     public function edit($id)
     {
         // Find the log by its ID
         $log = Log::findOrFail($id);
 
         // Return the edit view with the log data
         return view('edit', compact('log'));
     }
 
     // Method to update the log data
     public function update(Request $request, $id)
     {
         // Validate the incoming request
         $request->validate([
             'title' => 'required|string',
             'body' => 'required|string|max:255',
         ]);
 
         // Find the log by its ID
         $log = Log::findOrFail($id);
 
         // Update the log's fields
         $log->title = $request->input('title');
         $log->body = $request->input('body');
         $log->save(); // Save the updated log
 
         // Redirect back to the uploads page with success message
         return redirect()->route('uploads')->with('success', 'Log updated successfully.');
     }
    
}

