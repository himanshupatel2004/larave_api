<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactValidate;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $contacts = Contact::where('user_id', Auth::id())->paginate(5);

        if ($search) {
            $contacts = Contact::where('first_name', 'LIKE', '%' . $search . '%')
                ->orwhere('last_name', 'LIKE', '%' . $search . '%')
                ->orwhere('phone', 'LIKE', '%' . $search . '%')
                ->where('user_id', Auth::id())
                ->paginate(10);
        }
        return view('contact.list', compact('contacts', 'search'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $contacts = Contact::paginate(50);
        if ($search != '') {
            $contacts = Contact::where('first_name', 'LIKE', '%' . $search . '%')
                ->orwhere('last_name', 'LIKE', '%' . $search . '%')
                ->orwhere('phone', 'LIKE', '%' . $search . '%')
                ->paginate(10);
        }
        return view('contact-list', compact('contacts'));
        // dd($request->all(), "Search");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactValidate $request)
    {
        $contact = new Contact();
        $contact->user_id = Auth::id();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->phone = $request->phone;
        $contact->save();

        return redirect('contact/list')->with('success', 'Contact Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = Contact::find($id);
        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactValidate $request)
    {
        $id = $request->id;
        $contact = Contact::find($id);

        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->phone = $request->phone;
        $contact->save();
        return redirect('contact/list')->with('success', 'Contact updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $contact = Contact::find($id);

        $contact->delete();
        return redirect('contact/list')->with('success', 'Contact Deleted Successfully');
    }
}
