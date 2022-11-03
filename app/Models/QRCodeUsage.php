<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QRCodeUsage extends Model
{
    use HasFactory;

    protected $table = 'qr_code_usages';

    protected $fillable = [
        'qr_code_id',
    ];

    public function QRCode(): BelongsTo
    {
        return $this->belongsTo(QRCode::class, 'qr_code_id');
    }

}
