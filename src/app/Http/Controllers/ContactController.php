<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name',
            'first_name',
            'gender',
            'email',
            'address',
            'building',
            'category_id',
            'content',
            'tel1','tel2','tel3',
        ]);
        $contact['tel'] = $request->tel;

        $contact['category_content'] = Category::whereKey($contact['category_id'])->value('content');

        session(['contact_input' => $contact]);


        return view('confirm', compact('contact'));
    }

    public function back(Request $request)
    {
        return redirect('/')
        ->withInput(session('contact_input', []));
    }

    public function store(Request $request)
    {
        $data = [
        'category_id' => $request->input('category_id'),
        'first_name'  => $request->input('first_name'),
        'last_name'   => $request->input('last_name'),
        'gender'      => match ($request->input('gender')) {
            'male'    => 1,
            'female'  => 2,
            'other'   => 3,
            default   => 3,
        },
        'email'       => $request->input('email'),
        'tel'         => $request->input('tel'),
        'address'     => $request->input('address'),
        'building'    => $request->input('building'),
        'detail'      => $request->input('content'),
    ];

    Contact::create($data);

    return view('thanks');
    }
}
