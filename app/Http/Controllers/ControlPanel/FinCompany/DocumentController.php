<?php

namespace App\Http\Controllers\ControlPanel\FinCompany;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPanel\FinCompany\DocumentRequest;
use App\Http\Response\ResponseBuilder;
use App\Models\Document;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Auth()->user()->operator->company->documents;
        return view('control_panel.fin_company.documents.index',compact('documents'));
    }

    public function create()
    {
        return view('control_panel.fin_company.documents.create');
    }

    public function store(DocumentRequest $request): JsonResponse
    {
        $request->store();
        return ResponseBuilder::jsonRedirect(route('cp.fin.documents.index'));
    }

    public function edit(int $id)
    {
        $company = Auth()->user()->operator->company;
        if(!$document = Document::find($id)){
            return abort(404);
        }
        if($company->id != $document->fin_company_id) {
            return abort(403);
        }
        return view('control_panel.fin_company.documents.edit' ,compact('document'));
    }

    public function update(DocumentRequest $request, int $id)
    {
        $company = Auth()->user()->operator->company;
        if(!$document = Document::find($id)){
            return abort(404);
        }
        if($company->id != $document->fin_company_id) {
            return abort(403);
        }
        $request->update($id);
        return ResponseBuilder::jsonRedirect(route('cp.fin.documents.index'));
    }
}
