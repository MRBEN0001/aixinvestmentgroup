<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller
{
    public function index(Request $request)
    {
        // If you're rendering the import page, return a view
        return view('import.index');
    }

    public function mapColumn(Request $request)
    {

        $file = $request->file('file');
    $path = $file->storeAs('uploads', $file->getClientOriginalName());

    // Store the path or data for later processing
    session(['uploaded_file_path' => $path]);

    // Read the CSV/Excel file and extract column headings and sample rows
    $data = Excel::toArray([], $file);
    $columns = $data[0][0]; // Assuming first row is the column names
    $sampleRows = array_slice($data[0], 1, 5); // Sample 5 rows

    return response()->json([
        'columns' => $columns,
        'sampleRows' => $sampleRows
    ]);
    }

//     public function mapColumn(Request $request)
// {
//     $file = $request->file('file');

//     // Save the file
//     $path = $file->storeAs('uploads', $file->getClientOriginalName());
//     session(['uploaded_file_path' => $path]);

//     // Read the file
//     $data = Excel::toArray([], $file);
//     if (empty($data)) {
//         return response()->json(['error' => 'File not readable or empty']);
//     }

//     $columns = isset($data[0]) ? $data[0][0] : [];
//     $sampleRows = array_slice($data[0], 1, 5);

//     return response()->json([
//         'columns' => $columns,
//         'sampleRows' => $sampleRows
//     ]);
// }
    
    public function import(Request $request)
    {
        $request->validate([
            'columns' => 'required|array', // Ensure columns are provided
        ]);
    
        $mappings = $request->input('columns'); // Get user-defined mappings
    
        // Handle the file path (retrieved from session or direct request)
        $path = session('uploaded_file_path');
        if (!$path || !Storage::exists($path)) {
            return redirect()->back()->with('error', 'Uploaded file not found.');
        }
    
        $file = Storage::path($path);
    
        // Pass mappings to the UsersImport class
        Excel::import(new UsersImport($mappings), $file);
    
        Storage::delete($path); // Optionally delete file after processing
        return response()->json([
            'status' => 'success',
            'message' => 'Data imported successfully.',
            'mappings' => $mappings,
        ]);
    }
}
