<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'document_name.*' => 'required|string',
            'document_image_front.*' => 'required|image',
            'document_image_back.*' => 'nullable|image',
        ]);

        // Loop through the submitted data and create/save documents
        $user_name = User::find($id)->name;
        foreach ($request->document_name as $key => $value) {
            $document = new Document();
            $document->user_id = $id;
            $document->document_name = $request->document_name[$key];

            // Handle file uploads
            if ($request->hasFile('document_image_front.' . $key)) {
                $frontImage = $request->file('document_image_front.' . $key);
                $frontImageName = str_replace(" ", "_", $user_name). "_" .str_replace(" ", "_", $request->document_name[$key]) . '_front' . time() . '.' . $frontImage->getClientOriginalExtension();
                $frontImage->storeAs('public/user-documents', $frontImageName);
                $document->document_image_front = "user-documents/". $frontImageName;
            }

            if ($request->hasFile('document_image_back.' . $key)) {
                $backImage = $request->file('document_image_back.' . $key);
                $backImageName = str_replace(" ", "_", $user_name). "_" . str_replace(" ", "_", $request->document_name[$key]) . '_back' . time() . '.' . $backImage->getClientOriginalExtension();
                $backImage->storeAs('public/user-documents', $backImageName);
                $document->document_image_back = "user-documents/" . $backImageName;
            }
            $document->document_status = "verified";
            $document->save();
        }

        return redirect()->back()->with('success', 'Documents saved successfully.');
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
        $user = User::find($id);
        $documents = Document::where('user_id', $id)->get();
        return view('admin.document.add', compact('documents', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'document_name' => 'required|string',
            'document_image_front' => 'nullable|image',
            'document_image_back' => 'nullable|image',
        ]);

        // Find the document by ID
        $document = Document::findOrFail($id);

        $user_name = User::find($document->user_id)->name;
        // Update document fields
        $document->document_name = $request->document_name;

        if ($request->hasFile('document_image_front')) {
            $frontImage = $request->file('document_image_front');
            $frontImageName = str_replace(" ", "_", $user_name). "_" . str_replace(" ", "_", $request->document_name) . 'front' . time() . '.' . $frontImage->getClientOriginalExtension();
            $frontImage->storeAs('public/user-documents', $frontImageName);
            $document->document_image_front = "user-documents/". $frontImageName;
        }

        if ($request->hasFile('document_image_back')) {
            $backImage = $request->file('document_image_back');
            $backImageName = str_replace(" ", "_", $user_name). "_" . str_replace(" ", "_", $request->document_name) . 'back' . time() . '.' . $backImage->getClientOriginalExtension();
            $backImage->storeAs('public/user-documents', $backImageName);
            $document->document_image_back = "user-documents/" . $backImageName;
        }
        $document->document_status = $request->status;
        $document->save();

        return redirect()->back()->with('success', 'Document updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $document = Document::find($id);

        if($document){
            $document->delete();
        }
        return redirect()->back()->with('success', 'Document Deleted successfully.');
    }
}
