<?php

namespace App\Http\Controllers;

use App\Models\Kyc;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user-dashboard-pages.kyc.index');
    }

    public function kycProcess(Request $request)
    {
        // dd($request->file('id_document_front'));

        $request->validate([
            'date_of_birth' => 'required|date',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'id_type' => 'required|string',
            'id_document_front' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'id_document_back' => 'required|file|mimes:jpg,jpeg,png,pdf',
            'selfie' => 'required|file|mimes:jpg,jpeg,png',
        ]);

        $kyc = new Kyc();
        $kyc->user_id = auth()->id();
        $kyc->date_of_birth = $request->date_of_birth;
        $kyc->address = $request->address;
        $kyc->city = $request->city;
        $kyc->state = $request->state;
        $kyc->zip = $request->zip;
        $kyc->id_type = $request->id_type;
       
        $kyc->id_document_front = $request->file('id_document_front')->store('kyc_documents', 'public');
        $kyc->id_document_back = $request->file('id_document_back')->store('kyc_documents', 'public');
        $kyc->selfie = $request->file('selfie')->store('kyc_selfies', 'public');

        $kyc->save();

        return redirect()->back()->with('success', 'KYC successfully submitted!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
