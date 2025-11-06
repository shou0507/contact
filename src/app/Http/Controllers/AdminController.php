<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->only(['keyword','match','gender','category','date']);

        $contacts = Contact::with('category')
            ->filter($params)
            ->orderByDesc('id')
            ->paginate(7)
            ->withQueryString();

            $categories = Category::orderBy('id')->get(['id', 'content']);

            $selected = null;
            if($request->filled('detail')) {
                $selected = Contact::with('category')->find($request->query('detail'));
            }

        return view('admin', compact('contacts', 'categories', 'selected'));
    }

    public function destroy(Request $request, Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.index');
    }
}