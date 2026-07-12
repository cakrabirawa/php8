<?php

namespace App\Providers\Filament;

use Awcodes\LightSwitch\LightSwitchPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Support\Assets\Js;
use Filament\View\PanelsRenderHook;
use App\Filament\Pages\Auth\CustomLogin;
use Illuminate\Support\Facades\Auth;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Pages\EditRecord;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use BezhanSalleh\FilamentShield\Resources\Roles\RoleResource as RolesRoleResource;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\TextInput;
use Filament\Navigation\NavigationItem;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(CustomLogin::class)
            ->colors(['primary' => Color::Amber,])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([Dashboard::class,])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([AccountWidget::class, FilamentInfoWidget::class,])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // ->assets([
            //     Js::make('alpine-mask', 'https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js'),
            // ])
            ->font('Poppins')
            ->spa()
            ->colors([
                'primary' => Color::Fuchsia,
                'secondary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
                'danger' => Color::Rose,
            ])
            ->plugins([
                // LightSwitchPlugin::make(),
                FilamentShieldPlugin::make(),
            ])
            ->navigationItems([
                NavigationItem::make('Logout')
                    ->label('Keluar Sistem') // Teks yang muncul di sidebar
                    ->url(fn(): string => "javascript:document.getElementById('logout-form').submit();") // Rute logout otomatis Filament
                    ->icon('heroicon-o-arrow-left-on-rectangle') // Ikon pintu keluar
                    ->sort(1000)
                    // 2. Berikan nama grup khusus agar posisinya terpisah di paling bawah sidebar
                    ->group('Sistem')
                    ->visible(fn(): bool => auth()->check()), // Hanya muncul jika user sudah login
            ])
            ->renderHook(
                'panels::body.end',
                fn() => view('filament.components.logout-form')
            )
        ;
    }

    public function boot(): void {}
}
