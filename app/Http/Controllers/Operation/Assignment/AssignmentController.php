<?php

namespace App\Http\Controllers\Operation\Assignment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AssignmentController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function exportPdf()
    {
        $data = null;
        return view('operation.assignment.pdf');

        return PDF::loadView('operation.assignment.pdf', compact('data'))->download('my-pdf.pdf');
    }
}
