<?php
declare(strict_types = 1);

namespace App\Http\Controllers\Traits;

use Illuminate\Http\{
    JsonResponse,
    Request
};
use Tymon\JWTAuth\{
    Exceptions\JWTException,
    Facades\JWTAuth
};
use App\Models\User,
    App\Http\Transformers\User\UserTransformer;

/**
 * Class TokenFromUserTrait
 * @package App\Http\Traits
 */
trait TokenFromUserTrait
{
    /**
     * @param Request $request
     * @param User    $user
     * @return JsonResponse
     */
    public function loginUserObject(Request $request, User $user): JsonResponse
    {
        // Authenticate and generate JWT
        $customClaim = [
            'key' => $request->header('X-Device-Key'),
            'os'  => $request->header('X-Device-Os'),
        ];

        try {
            if (! $token = JWTAuth::fromUser($user, $customClaim)) {
                $response = $this->unauthorizedResponse(trans('auth.failed'));
            } else {
                $user->devices()->firstOrCreate($customClaim);
                $response = $this->successResponse([
                    'token' => $token,
                    'user'  => $this->transformDataForResponse(new UserTransformer(), $user->fresh()),
                ]);
            }
        } catch (JWTException $e) {
            $response = $this->internalErrorResponse(trans('auth.jwt.token_not_generated'));
        }

        return $response;
    }
}
