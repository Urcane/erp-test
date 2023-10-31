<?php

namespace App\Http\Controllers\Finance\Invoice;

use App\Constants;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    private $constants;

    public function __construct()
    {
        $this->constants = new Constants();
    }

    public function viewDashboard()
    {
        $status = $this->constants->invoice_status;

        return view('finance.invoice.dashboard', compact([
            'status'
        ]));
    }

    public function viewInvoice()
    {
        return view('finance.invoice.invoice.index');
    }

    public function viewJournal()
    {
        return view('finance.invoice.journal.index');
    }

    public function viewMasterdata()
    {
        return view('finance.invoice.master-data.index');
    }

    public function viewLogs()
    {
        return view('finance.invoice.logs.index');
    }
}
