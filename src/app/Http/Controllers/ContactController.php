<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Contact::create(
            $request->validate([
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'message' => ['required'],
            ])
        );

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}