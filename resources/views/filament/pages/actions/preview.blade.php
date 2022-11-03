{!! QrCode::size($record->size)
    ->color($record->color)
    ->backgroundColor($record->background_color)
    ->style($record->style)
    ->eye($record->eye)
    ->errorCorrection($record->error_correction)
    ->generate($record->content)
!!}
