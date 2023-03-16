<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InquiryRequest;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int|null  $limit
     * @param  int|null  $skip
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inquiries = Inquiry::paginate();

        return response()->json($inquiries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InquiryRequest $request)
    {
        $inquiry = Inquiry::create($request->validated());

        return response()->json($inquiry, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show($inquiry)
    {
        $inquiry = Inquiry::findOrFail($inquiry);

        return response()->json($inquiry);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquiry $inquiry)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'string|max:255',
            'description' => 'nullable',
            'company' => 'nullable',
            'mobile' => 'nullable',
            'telephone' => 'nullable',
        ]);

        $inquiry->update($validatedData);

        return response()->json($inquiry);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        $inquiry->delete();

        return response()->json(['message' => 'Inquiry deleted successfully.']);
    }
}
