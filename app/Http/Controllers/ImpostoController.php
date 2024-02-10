<?php

namespace App\Http\Controllers;

use App\Models\Imposto;
use Illuminate\Http\Request;

class ImpostoController extends Controller
{
    public function index()
    {
        $taxTableEntries = Imposto::all();
        return view('tax_table_entries.index', compact('taxTableEntries'));
    }

    public function create()
    {
        return view('tax_table_entries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Add validation rules based on your requirements
        ]);

        Imposto::create($request->all());

        return redirect()->route('tax_table_entries.index')->with('success', 'Tax table entry created successfully');
    }

    public function edit(Imposto $taxTableEntry)
    {
        return view('tax_table_entries.edit', compact('taxTableEntry'));
    }

    public function update(Request $request, Imposto $taxTableEntry)
    {
        $request->validate([
            // Add validation rules based on your requirements
        ]);

        $taxTableEntry->update($request->all());

        return redirect()->route('tax_table_entries.index')->with('success', 'Tax table entry updated successfully');
    }

    public function destroy(Imposto $taxTableEntry)
    {
        $taxTableEntry->delete();

        return redirect()->route('tax_table_entries.index')->with('success', 'Tax table entry deleted successfully');
    }
}
