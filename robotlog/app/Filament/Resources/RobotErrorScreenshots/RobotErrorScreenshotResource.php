<?php

namespace App\Filament\Resources\RobotErrorScreenshots;

use App\Filament\Resources\RobotErrorScreenshots\Pages\CreateRobotErrorScreenshot;
use App\Filament\Resources\RobotErrorScreenshots\Pages\EditRobotErrorScreenshot;
use App\Filament\Resources\RobotErrorScreenshots\Pages\ListRobotErrorScreenshots;
use App\Filament\Resources\RobotErrorScreenshots\Pages\ViewRobotErrorScreenshot;
use App\Filament\Resources\RobotErrorScreenshots\Schemas\RobotErrorScreenshotForm;
use App\Filament\Resources\RobotErrorScreenshots\Schemas\RobotErrorScreenshotInfolist;
use App\Filament\Resources\RobotErrorScreenshots\Tables\RobotErrorScreenshotsTable;
use App\Models\RobotErrorScreenshot;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class RobotErrorScreenshotResource extends Resource
{
  protected static ?string $model = RobotErrorScreenshot::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoto;

  protected static ?string $recordTitleAttribute = 'nama_robot';

  protected static string|UnitEnum|null $navigationGroup = 'Robot Logs';

  protected static ?string $navigationLabel = 'Robot Screenshots';

  public static function form(Schema $schema): Schema
  {
    return RobotErrorScreenshotForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return RobotErrorScreenshotInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return RobotErrorScreenshotsTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListRobotErrorScreenshots::route('/'),
      'create' => CreateRobotErrorScreenshot::route('/create'),
      'view' => ViewRobotErrorScreenshot::route('/{record}'),
      'edit' => EditRobotErrorScreenshot::route('/{record}/edit'),
    ];
  }

  public static function getNavigationBadge(): ?string
  {
    return static::getModel()::count();
  }
}
