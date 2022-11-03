<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{

    use HasFactory;

    protected $table = 'qr_codes';

    protected $fillable = [
        'type',
        'content',
        'user_id',
        'size',
        'color',
        'background_color',
        'style',
        'eye_style',
        'error_correction_level',
        'image',
    ];

    public function getColorRGB()
    {
        list($r, $g, $b) = sscanf($this->color, "#%02x%02x%02x");
        return [
            'r' => $r,
            'g' => $g,
            'b' => $b,
        ];
    }
    public function getBackgroundColorRGB()
    {
        list($r, $g, $b) = sscanf($this->background_color, "#%02x%02x%02x");
        return [
            'r' => $r,
            'g' => $g,
            'b' => $b,
        ];
    }
}
