<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // 1. Authentication Exception (Belum Login)
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Anda belum login. Silakan login terlebih dahulu.',
                    'error' => 'Unauthenticated'
                ], 401);
            }
        });

        // 2. Validation Exception (Input Salah)
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Data yang dikirim tidak valid. Silakan periksa input Anda.',
                    'errors' => $e->errors(),
                ], 422);
            }
        });

        // 3. Model Not Found (ID Tidak Ada)
        $exceptions->render(function (\Illuminate\Database\Eloquent\ModelNotFoundException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Data tidak ditemukan.',
                    'error' => 'Not Found'
                ], 404);
            }
        });

        // 4. Route/URL Not Found
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Endpoint atau data tidak ditemukan.',
                    'error' => 'Not Found'
                ], 404);
            }
        });

        // 5. General Server Error (Lainnya)
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Terjadi kesalahan pada server.',
                    'error' => $e->getMessage(), // Bisa di-hide jika production
                ], 500);
            }
        });
    })->create();
