{!! QrCode::size($record->size)
    ->color($record->getColorRGB()['r'], $record->getColorRGB()['g'], $record->getColorRGB()['b'])
    ->backgroundColor($record->getBackgroundColorRGB()['r'], $record->getBackgroundColorRGB()['g'], $record->getBackgroundColorRGB()['b'])
    ->style($record->style)
    ->eye($record->eye_style)
    ->errorCorrection($record->error_correction_level)
    ->generate($record->content)
!!}
