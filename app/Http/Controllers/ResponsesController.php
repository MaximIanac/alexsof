<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ResponsesModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResponsesController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'formData' => 'required|array',
            'formData.attending' => 'required|boolean',
            'formData.attending_with_partner' => 'nullable|boolean',
            'formData.first_name' => 'required|string|max:255',
            'formData.last_name' => 'required|string|max:255',
            'formData.partner_first_name' => 'nullable|string|max:255|required_if:formData.attending_with_partner,true',
            'formData.partner_last_name' => 'nullable|string|max:255|required_if:formData.attending_with_partner,true',
            'formData.drink_preferences' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $validatedData = $validator->validated()['formData'];

        if (!$validatedData['attending_with_partner']) {
            $validatedData['partner_first_name'] = '';
            $validatedData['partner_last_name'] = '';
        }

        $response = ResponsesModel::create([
            'attending' => $validatedData['attending'],
            'attending_with_partner' => $validatedData['attending_with_partner'] ?? null,
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'partner_first_name' => $validatedData['partner_first_name'] ?? null,
            'partner_last_name' => $validatedData['partner_last_name'] ?? null,
            'drink_preferences' => implode(', ', $validatedData['drink_preferences']) ?? null,
        ]);

        return response()->json([
            "message" => "Данные сформированы",
            "data" => $response
        ]);

    }

    public function index(): JsonResponse
    {
        $rsvps = ResponsesModel::all();

        return response()->json($rsvps);
    }

    public function destroy($id): JsonResponse
    {
        $response = ResponsesModel::find($id);

        if (!$response) {
            return response()->json(['message' => 'Запись не найдена'], 404);
        }

        $response->delete();

        return response()->json(['message' => 'Запись успешно удалена']);
    }
}
