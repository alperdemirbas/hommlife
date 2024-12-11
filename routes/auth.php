<?php

use App\Http\Controllers\User\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\Auth\ConfirmablePasswordController;
use App\Http\Controllers\User\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\User\Auth\EmailVerificationPromptController;
use App\Http\Controllers\User\Auth\NewPasswordController;
use App\Http\Controllers\User\Auth\PasswordController;
use App\Http\Controllers\User\Auth\PasswordResetLinkController;
use App\Http\Controllers\User\Auth\RegisteredUserController;
use App\Http\Controllers\User\Auth\VerifyEmailController;

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController as AdminConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController as AdminEmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController as AdminEmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController as AdminNewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordController as AdminPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController as AdminPasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController as AdminUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController as AdminVerifyEmailController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [AdminUserController::class, 'create'])
            ->name('admin.register');

        Route::post('register', [AdminUserController::class, 'store']);

        Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
            ->name('admin.login');

        Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])
            ->name('admin.password.request');

        Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])
            ->name('admin.password.email');

        Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])
            ->name('admin.password.reset');

        Route::post('reset-password', [AdminNewPasswordController::class, 'store'])
            ->name('admin.password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('verify-email', AdminEmailVerificationPromptController::class)
            ->name('admin.verification.notice');

        Route::get('verify-email/{id}/{hash}', AdminVerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('admin.verification.verify');

        Route::post('email/verification-notification', [AdminEmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('admin.verification.send');

        Route::get('confirm-password', [AdminConfirmablePasswordController::class, 'show'])
            ->name('admin.password.confirm');

        Route::post('confirm-password', [AdminConfirmablePasswordController::class, 'store']);

        Route::put('password', [AdminPasswordController::class, 'update'])->name('admin.password.update');

        Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
            ->name('admin.logout');
    });
});

Route::prefix('/')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])
            ->name('register');

        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    Route::middleware('auth')->group(function () {
        Route::get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        Route::put('password', [PasswordController::class, 'update'])->name('password.update');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
});
