<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionSupport;
use App\Models\Patient;

class DecisionSupportController extends Controller
{
    public function index()
    {
        $decisionSupports = DecisionSupport::with('patient')->get();
        return view('decision_support.index', compact('decisionSupports'));
    }

    public function create()
    {
        $patients = Patient::all(); // Retrieve all patients
        return view('decision_support.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'analysis_data' => 'required|json',
            'recommendation' => 'required|string',
        ]);

        DecisionSupport::create($request->all());
        return redirect()->route('decision-support.index')->with('success', 'Decision support entry created successfully.');
    }

    public function edit($id)
    {
        $decisionSupport = DecisionSupport::findOrFail($id);
        $patients = Patient::all(); // Retrieve all patients
        return view('decision_support.edit', compact('decisionSupport', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'analysis_data' => 'required|json',
            'recommendation' => 'required|string',
        ]);

        $decisionSupport = DecisionSupport::findOrFail($id);
        $decisionSupport->update($request->all());
        return redirect()->route('decision-support.index')->with('success', 'Decision support entry updated successfully.');
    }

    public function destroy($id)
    {
        $decisionSupport = DecisionSupport::findOrFail($id);
        $decisionSupport->delete();
        return redirect()->route('decision-support.index')->with('success', 'Decision support entry deleted successfully.');
    }
}
