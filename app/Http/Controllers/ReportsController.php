<?php

namespace App\Http\Controllers;

use App\Jobs\CompileReport;
use Illuminate\Http\Request;

use App\Http\Requests;

class ReportsController extends Controller
{
    public function index()
    {
        $job = new CompileReport(2);
        $this->dispatch($job);

        return 'Done!';
    }
}
