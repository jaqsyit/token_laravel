<?php


namespace App\Services;

use App\Models\Restriction;
use Exception;
use Illuminate\Http\JsonResponse;

class RestrictionsService
{
    public function createOrUpdate($data)
    {
        try {
            $requestData = $data->all();
            $result = Restriction::createOrUpdate($requestData);

            $status = $result['wasRecentlyCreated'] ? 201 : 200;
            $message = $result['wasRecentlyCreated'] ? 'New data added' : 'Data updated';

            return response()->json(['message' => $message, 'data' => $result['data']], $status);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function delete($data)
    {
        $restriction = Restriction::where('token', $data['token'])
            ->where('service', $data['service'])
            ->first();


        if (!$restriction) {
            return response()->json(['message' => 'Token not found', 'token' => $data['token'], 'service' => $data['service']], 404);
        }
        $restriction->delete();
        return response()->json(['success' => 'Token deleted', 'token' => $restriction], 200);
    }

    public function info($data)
    {
        try {
            $requestData = $data->all();
            $zapis = Restriction::where('service', $requestData['service'])
                ->where('token', $requestData['token'])
                ->first();

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Info found', 'data' => $zapis], 200);
    }
}
