<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UploadFileRequest;
use App\Http\Resources\Api\UploadedFileResource;
use App\Models\FileUpload;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class UploadFile extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param UploadFileRequest $request
     * @return UploadedFileResource
     * @throws Exception
     */
    public function __invoke(UploadFileRequest $request)
    {
        $path = Storage::putFile('uploads', $request->file('file'));

        Log::debug('request', $request->toArray());


        $fileUpload = new FileUpload([
            'path' => $path,
            'access_token' => Uuid::uuid4(),
        ]);

        $fileUpload->save();

        return new UploadedFileResource($fileUpload);
    }
}