<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        
        return view('user.pages.document.index')
        ->with('documents', $documents);
    }
}
