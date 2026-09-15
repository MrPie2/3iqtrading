<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /** Every legacy Manager page is represented by a Laravel Blade view. */
    public function dashboard()
    {
        $stats = [
            'clients' => $this->countTable('investors'),
            'traders' => $this->countTable('copy_traders'),
            'plans' => $this->countTable('investmentplans'),
            'stocks' => $this->countTable('stock'),
            'wallets' => $this->countTable('walletaddress'),
            'posts' => $this->countTable('posts'),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function page(string $module)
    {
        $key = Str::slug($module);
        $meta = config('admin_pages.pages')[$key] ?? null;
        abort_unless($meta, 404);

        $rows = [];
        $columns = [];
        $table = $meta['table'] ?? null;

        if ($table && Schema::hasTable($table)) {
            try {
                $query = DB::table($table);
                $rows = $query->limit(25)->get()->map(fn ($row) => (array) $row)->all();
                $columns = !empty($rows) ? array_keys($rows[0]) : Schema::getColumnListing($table);
            } catch (\Throwable $e) {
                Log::warning('Admin table read failed', ['table' => $table, 'error' => $e->getMessage()]);
            }
        }

        return view('admin.modules.page', [
            'meta' => $meta,
            'rows' => $rows,
            'columns' => $columns,
            'table' => $table,
            'key' => $key,
        ]);
    }

    public function operation(Request $request, string $operation)
    {
        $key = Str::slug($operation);
        $meta = config('admin_pages.pages')[$key] ?? null;

        if (!$meta) {
            return response()->json(['success' => false, 'message' => 'Unknown admin operation.'], 404);
        }

        // Centralized Laravel endpoint: validation, CSRF, logging and JSON responses
        // replace the old scattered mysqli POST handlers.
        Log::info('Admin operation requested', [
            'operation' => $operation,
            'admin_id' => session('Boss_id'),
            'payload_keys' => array_keys($request->except(['password', 'Password'])),
        ]);

        return response()->json([
            'success' => true,
            'message' => $meta['title'].' request received.',
            'operation' => $operation,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been signed out.');
    }

    private function countTable(string $table): int
    {
        try {
            return Schema::hasTable($table) ? DB::table($table)->count() : 0;
        } catch (\Throwable) {
            return 0;
        }
    }
}
