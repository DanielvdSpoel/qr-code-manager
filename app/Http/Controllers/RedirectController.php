<?php

namespace App\Http\Controllers;

use App\Models\QRCode;
use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirect($QRCode)
    {
        $QRCode = QRCode::find($QRCode)->first();
        if ($QRCode->type !== 'url') {
            abort(404);
        }

        //todo implement tracking

        return redirect($QRCode->content);
    }
}
