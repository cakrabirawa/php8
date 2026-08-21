<?php

namespace App\Filament\Resources\RobotErrorScreenshots\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RobotErrorScreenshotInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama_robot')
                    ->label('Nama Robot'),

                TextEntry::make('file_name')
                    ->label('Nama File'),

                ImageEntry::make('file_name')
                    ->label('Preview')
                    ->defaultImageUrl(null)
                    ->getStateUsing(function ($record) {
                        return $record->image_url ?: null;
                    })
                    ->url(fn($record) => $record->image_url ?: null)
                    ->openUrlInNewTab()
                    ->imageHeight(500)
                    ->imageWidth(500)
                    ->extraImgAttributes([
                        'class' => 'mx-auto block cursor-zoom-in',
                        'style' => 'object-fit: contain; object-position: center;',
                    ]),

                TextEntry::make('created_at')
                    ->label('Created At')
                    ->dateTime('d/m/Y H:i:s'),
            ]);
    }
}
