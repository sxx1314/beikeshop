<?php

use Beike\Installer\Controllers\DatabaseController;
use Beike\Installer\Controllers\EnvironmentController;
use Beike\Installer\Controllers\FinalController;
use Beike\Installer\Controllers\PermissionsController;
use Beike\Installer\Controllers\RequirementsController;
use Beike\Installer\Controllers\WelcomeController;

Route::prefix('installer')
    ->name('installer.')
    ->middleware(['installer'])
    ->group(function () {
        Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
        Route::get('lang/{lang}', [WelcomeController::class, 'index'])->name('lang.switch');
        Route::get('requirements', [RequirementsController::class, 'index'])->name('requirements');
        Route::get('permissions', [PermissionsController::class, 'index'])->name('permissions');
        Route::get('environment', [EnvironmentController::class, 'index'])->name('environment');
        Route::post('environment/save', [EnvironmentController::class, 'saveWizard'])->name('environment.save');
        Route::get('database', [DatabaseController::class, 'index'])->name('database');
        Route::get('final', [FinalController::class, 'index'])->name('final');

    });
