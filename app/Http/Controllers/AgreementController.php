<?php


namespace App\Http\Controllers;

use App\UserAgreement;

class AgreementController extends Controller
{
    public function index()
    {
        $agreement = UserAgreement::limit(1)->orderBy('created_at')->get();

        return view('agreement.list', [
            'agreement' => $agreement[0]->body
        ]);
    }

}