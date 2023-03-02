<?php

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

if (!function_exists('ok')) {
	function ok($data = null, $message = 'OK'): JsonResponse
	{
		return response()->json([
			'status' => Response::HTTP_OK,
			'success' => true,
			'message' => $message,
			'data' => $data,
		]);
	}
}

if (!function_exists('bad')) {
	function bad($data = null, $message = 'Bad Request'): JsonResponse
	{
		return response()->json([
			'status' => Response::HTTP_BAD_REQUEST,
			'success' => false,
			'message' => $message,
			'data' => $data,
		], Response::HTTP_BAD_REQUEST);
	}
}

if (!function_exists('created')) {
	function created($data = null, $message = 'Created'): JsonResponse
	{
		return response()->json([
			'status' => Response::HTTP_CREATED,
			'success' => true,
			'message' => $message,
			'data' => $data,
		], Response::HTTP_CREATED);
	}
}

if (!function_exists('accepted')) {
	function accepted($data = null, $message = 'Accepted'): JsonResponse
	{
		return response()->json([
			'status' => Response::HTTP_ACCEPTED,
			'success' => true,
			'message' => $message,
			'data' => $data,
		], Response::HTTP_ACCEPTED);
	}
}

if (!function_exists('forbidden')) {
	function forbidden($message = 'Forbidden'): JsonResponse
	{
		return response()->json([
			'status' => Response::HTTP_FORBIDDEN,
			'success' => false,
			'message' => $message
		], Response::HTTP_FORBIDDEN);
	}
}
