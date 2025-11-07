<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use App\Models\PendingVisitor;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Register permission middleware globally
        app('router')->aliasMiddleware('permission', \App\Http\Middleware\CheckPermission::class);

        // Only run if the table exists to avoid migration-time errors
        if (Schema::hasTable('pending_visitors')) {
            $today = Carbon::today();

            // Count visitors whose visit_date is today or earlier
            $totalPendingVisitors = PendingVisitor::whereDate('visit_date', '<=', $today)->count();

            // Store count in a global config variable
            config([
                'adminlte.notification_counts.pending_visitors' => $totalPendingVisitors,
            ]);

            // Dynamically modify AdminLTE topnav bell menu
            $menu = config('adminlte.menu');

            foreach ($menu as &$item) {
                if (isset($item['id']) && $item['id'] === 'notificationBell') {
                    $item['label'] = (string) $totalPendingVisitors;
                    $item['label_color'] = $totalPendingVisitors > 0 ? 'danger' : 'success';

                    foreach ($item['submenu'] as &$submenu) {
                        if (str_contains($submenu['text'], 'Pending Visitor')) {
                            $submenu['text'] = "Pending Visitor List ({$totalPendingVisitors})";
                        }
                    }
                }
            }

            // Apply updated menu back to config
            config(['adminlte.menu' => $menu]);
        }
    }
}
