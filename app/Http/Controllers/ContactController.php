<?php


namespace App\Http\Controllers;

use App\Contact;
use App\Feedback;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('general')->get()->toArray();

        return view('contact.contact', [
            'contacts' => array_reverse($contacts)
        ]);
    }

    public function indexView($id = null)
    {
        $contacts = Contact::all()->toArray();

        $result = [];

        if ($id)
        {
            foreach ($contacts as $contactId => $contact)
            {
                if ($contact['id'] == $id)
                {
                    $contact['general'] = true;
                    $result['general'] = $contact;
                }
                else
                {
                    $contact['general'] = false;
                    $result[$contactId] = $contact;
                }
            }
        }
        sort($result, SORT_REGULAR);

        return view('contact.contact', [
            'contacts' => $result
        ]);
    }

    public function feedback()
    {
        $contacts = Contact::orderBy('general')->get()->toArray();

        return view('contact.feedback',[
            'contacts' => array_reverse($contacts)
        ]);
    }

    public function save(Request $request)
    {
        $data = $request->all();

        $feedback = new Feedback();

        $feedback->company = $data['company'];
        $feedback->contact = $data['contact'];
        $feedback->email = $data['email'];
        $feedback->message = $data['message'];
        $feedback->agreement = $data['agreement'];

        $feedback->save();
    }
}