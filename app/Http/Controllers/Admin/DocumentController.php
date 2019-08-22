<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Services\ServiceDocument;
use App\Document;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::all();
        return view('admin.pages.document.index')
        ->with('documents', $documents);
    }

    public function create()
    {
        return view('admin.pages.document.create');
    }

    public function store(DocumentRequest $request, ServiceDocument $sv)
    {
        $data['name'] = $request->name;
        try {
            $data['file'] = $sv->saveImage($request->file('file'), $request->name);
            Document::create($data);
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }

        return redirect()->route('admin.document.index')->with('success', 'Documento Adicionado com sucesso');
    }

    public function edit(Document $document)
    {
        return view('admin.pages.document.edit')
        ->with('document', $document);
    }

    public function update(DocumentRequest $request, ServiceDocument $sv, Document $document)
    {
        $data['name'] = $request->name;
        if(request()->has('file')){
            $data['file'] = $sv->saveImage($request->file('file'), $request->name);
        }
        try {
            $document->update($data);
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }

        return redirect()->route('admin.document.index')->with('success', 'Documento Alterado com sucesso');
    }

    public function delete(Document $document)
    {
        try {
            $document->delete();
        } catch (\Exception $e) {
            return redirect()->back()
            ->with('error','Ops, tivemos um problema, entre em contato com um de nossos adminsitradores: '. $e->getMessage() );
        }

        return redirect()->back()->with('success', 'Documento Removido com sucesso');
    }
}
