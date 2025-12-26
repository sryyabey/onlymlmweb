<?php

namespace App\Http\Controllers\Doc;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocController extends Controller
{
    public function index()
    {
        return view('doc.index');
    }

    public function show(string $slug)
    {
        return view('doc.show', ['slug' => $slug]);
    }
}
