<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DecisionSupport;
use App\Models\Patient;

/**
 * @OA\Info(
 *     title="Clinical Decision Support System API",
 *     version="1.0.0",
 *     description="API documentation for the Clinical Decision Support System",
 *     @OA\Contact(
 *         email="support@example.com"
 *     ),
 *     @OA\License(
 *         name="MIT",
 *         url="https://opensource.org/licenses/MIT"
 *     )
 * )
 */

 /**
 * @OA\Schema(
 *     schema="DecisionSupport",
 *     type="object",
 *     required={"patient_id", "analysis_data", "recommendation"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID of the decision support entry"
 *     ),
 *     @OA\Property(
 *         property="patient_id",
 *         type="integer",
 *         description="ID of the patient"
 *     ),
 *     @OA\Property(
 *         property="analysis_data",
 *         type="string",
 *         description="Analysis data in JSON format"
 *     ),
 *     @OA\Property(
 *         property="recommendation",
 *         type="string",
 *         description="Recommendation based on the analysis"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Creation timestamp"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Update timestamp"
 *     )
 * )
 */

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

    /**
     * Display a listing of the resource.
     *
     * @OA\Get(
     *     path="/api/decision-support",
     *     tags={"Decision Support"},
     *     summary="Get all decision support entries",
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/DecisionSupport"))
     *     )
     * )
     */
    public function apiIndex()
    {
        \Log::info('apiIndex called');
        return response()->json(DecisionSupport::all(), 200);
    }

    /**
     * Store a newly created resource.
     *
     * @OA\Post(
     *     path="/api/decision-support",
     *     tags={"Decision Support"},
     *     summary="Create a new decision support entry",
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/DecisionSupport")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Resource created successfully"
     *     )
     * )
     */
    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'analysis_data' => 'required|json',
            'recommendation' => 'required|string',
        ]);

        $decisionSupport = DecisionSupport::create($validated);

        return response()->json($decisionSupport, 201);
    }

    /**
     * Show the specified resource.
     *
     * @OA\Get(
     *     path="/api/decision-support/{id}",
     *     tags={"Decision Support"},
     *     summary="Get a single decision support entry",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the decision support entry",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(ref="#/components/schemas/DecisionSupport")
     *     )
     * )
     */
    public function apiShow($id)
    {
        $decisionSupport = DecisionSupport::findOrFail($id);

        return response()->json($decisionSupport, 200);
    }

    /**
     * Update the specified resource.
     *
     * @OA\Put(
     *     path="/api/decision-support/{id}",
     *     tags={"Decision Support"},
     *     summary="Update an existing decision support entry",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the decision support entry",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(ref="#/components/schemas/DecisionSupport")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     )
     * )
     */
    public function apiUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'patient_id' => 'exists:patients,id',
            'analysis_data' => 'json',
            'recommendation' => 'string',
        ]);

        $decisionSupport = DecisionSupport::findOrFail($id);
        $decisionSupport->update($validated);

        return response()->json($decisionSupport, 200);
    }

    /**
     * Remove the specified resource.
     *
     * @OA\Delete(
     *     path="/api/decision-support/{id}",
     *     tags={"Decision Support"},
     *     summary="Delete a decision support entry",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the decision support entry",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Resource deleted successfully"
     *     )
     * )
     */
    public function apiDestroy($id)
    {
        $decisionSupport = DecisionSupport::findOrFail($id);
        $decisionSupport->delete();

        return response()->json(null, 204);
    }
}