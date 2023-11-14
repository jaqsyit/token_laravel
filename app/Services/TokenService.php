<?php


namespace App\Services;

use App\Models\Restriction;
use App\Models\Token;
use Exception;
use Illuminate\Http\JsonResponse;

class TokenService
{
    public function refreshToken($data)
    {
        try {
            $oldTokenRestriction = Restriction::where('token', $data['token'])->first();
            if ($oldTokenRestriction) {
                $requestData = $data->all();
                $newToken = Token::refreshToken($requestData);


                Restriction::where('token', $data['token'])->update(['token' => $newToken['token_new']]);
            } else {
                return response()->json(['message' => 'Token not found', 'token' => $data['token']]);
            }

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json(['success' => 'Token refreshed', 'token' => $newToken], 200);
    }

}
