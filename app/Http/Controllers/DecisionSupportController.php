<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionSupport;
use App\Models\Patient;

class DecisionSupportController extends Controller
{
    public function index()
    {
        $data = DecisionSupport::with('patient')->get();
        // Decode analysis_data JSON for each entry
        $data->map(function ($item) {
            $item->decoded_analysis_data = json_decode($item->analysis_data, true);
            return $item;
        });
        \Log::info('Processed Data:', $data->toArray()); // Log the processed data for verification
        return view('decision_support.index', ['data' => $data]);
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
        $data = DecisionSupport::findOrFail($id); // Fetch the specific record
        $patients = Patient::all(); // Fetch all patients for the dropdown, if applicable

        return view('decision_support.edit', compact('data', 'patients')); // Pass both variables
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
