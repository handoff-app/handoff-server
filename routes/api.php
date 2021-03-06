<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::namespace('Api\V1')
     ->name('api.v1.')
     ->prefix('v1')
     ->group(function () {
         Route::post('files', 'UploadFile')->name('upload-file');
         Route::get('files/{fileUpload}', 'DownloadFile')
              ->name('download-file')
              ->middleware('jwt:FileUpload-view');
         Route::get('files/{fileUpload}/delete', 'DeleteFile')
              ->name('delete-file-action')
              ->middleware('jwt:FileUpload-delete');
         Route::delete('files/{fileUpload}', 'DeleteFile')
              ->name('delete-file')
              ->middleware('jwt:FileUpload-delete');
     });
