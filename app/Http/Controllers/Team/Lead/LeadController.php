<?php

namespace App\Http\Controllers\Team\Lead;

use App\DataTables\Team\Lead\LeadDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(LeadDataTable $LeadDataTable)
    {
        return $LeadDataTable->render('team.lead.index');
    }

}
