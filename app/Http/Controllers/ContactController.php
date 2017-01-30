<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Contact::all());
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:40',
            'email' => 'required|email|unique:contacts|max:30',
            'mobile' => 'required|unique:contacts|max:15'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // saving on contact model
        $newContact = new Contact();
        $newContact->name = $request->input('name');
        $newContact->email = $request->input('email');
        $newContact->mobile = $request->input('mobile');
        $newContact->save();
        return response()->json($newContact, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Contact::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:40',
                'email' => 'required|email|unique:contacts,email,' . $id . '|max:30',
                'mobile' => 'required|unique:contacts,mobile,' . $id . '|max:15'
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $contact = Contact::findOrFail($id);
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->mobile = $request->input('mobile');
        return response()->json($contact, 204);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Contact::destroy($id)) {
            return response()->json(['result' => 'deleted']);
        } else {
            return response()->json(['result' => 'record not found']);
        }

    }
}
