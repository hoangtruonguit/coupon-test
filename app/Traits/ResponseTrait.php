<?php
/**
 * Created by PhpStorm.
 * User: reishou
 * Date: 10/18/17
 * Time: 9:21 PM
 */

namespace App\Traits;

trait ResponseTrait
{
    protected function success($data)
    {

        return response()->json(
            [
                'status' => true,
                'data'   => $data,
            ]
        );
    }

    protected function error($message, $status = 400)
    {
        return response()->json(
            [
                'status' => false,
                'data'   => null,
                'error'  => [
                    'code'    => $status,
                    'message' => is_array($message) ? $message : [$message],
                ],
            ],
            $status
        );
    }

    protected function refresh($message = 'OK', $data)
    {
        return response()->json(
            [
                'status' => true,
                'message' => $message,
                'data'   => $data,
            ]
        );
    }

    protected function notFound()
    {
        return $this->error('RESOURCE_NOT_FOUND', 404);
    }

    protected function notAuthorize($message = 'NOT_AUTHORIZE_FOR_THIS_URI')
    {
        return $this->error($message, 403);
    }

    protected function tokenIsExpired()
    {
        return $this->error('TOKEN EXPIRED', 401);

    }



}
