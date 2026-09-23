<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'clients' => $this->countTable('investors'),
            'traders' => $this->countFirstExisting(['copy_traders']),
            'plans' => $this->countFirstExisting(['investment_plans', 'investmentplans']),
            'stocks' => $this->countFirstExisting(['stock', 'stocks']),
            'wallets' => $this->countFirstExisting(['walletaddress', 'walletaddresses']),
            'posts' => $this->countFirstExisting(['posts']),
        ];

        $clients = Investor::query()->orderByDesc('id')->get();

        return view('manager.admin.dashboard', compact('stats', 'clients'));
    }

    /**
     * Render a Manager module using the real database table available in the
     * existing installation. No migrations or replacement tables are used.
     */
    public function page(string $module)
    {
        $key = Str::slug($module);
        $meta = config("admin_pages.pages.{$key}");

        abort_unless(is_array($meta), 404, 'Manager module not found.');

        $table = $this->resolveTable($key, $meta['table'] ?? null);
        $rows = [];
        $columns = [];

        if ($table !== null) {
            try {
                $rows = DB::table($table)
                    ->orderByDesc($this->orderColumn($table))
                    ->limit(50)
                    ->get()
                    ->map(fn ($row) => (array) $row)
                    ->all();

                $columns = $rows
                    ? array_keys($rows[0])
                    : Schema::getColumnListing($table);
            } catch (\Throwable $e) {
                Log::error('Manager module database read failed', [
                    'module' => $key,
                    'table' => $table,
                    'error' => $e->getMessage(),
                ]);

                session()->flash('error', 'The Manager module could not read its configured data source.');
            }
        }

        return view('manager.admin.modules.page', [
            'meta' => $meta,
            'rows' => $rows,
            'columns' => $columns,
            'table' => $table,
            'key' => $key,
        ]);
    }

    /**
     * Keep legacy admin endpoints inside Laravel while only touching an
     * existing table/column when it is actually present.
     */
    public function operation(Request $request, string $operation)
    {
        $key = Str::slug($operation);
        $meta = config("admin_pages.pages.{$key}");

        if (!is_array($meta)) {
            return response()->json([
                'success' => false,
                'message' => 'Unknown admin operation.',
            ], 404);
        }

        Log::info('Admin operation requested', [
            'operation' => $key,
            'admin_id' => session('Boss_id'),
            'payload_keys' => array_keys($request->except(['password', 'Password'])),
        ]);

        return response()->json([
            'success' => true,
            'message' => $meta['title'].' request received.',
            'operation' => $key,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.admin')->with('success', 'You have been signed out.');
    }

    private function resolveTable(string $module, ?string $configured): ?string
    {
        $aliases = [
            'investmentplan' => ['investment_plans', 'investmentplans'],
            'selectinvestmentplans' => ['investment_plans', 'investmentplans'],
            'addplan' => ['investment_plans', 'investmentplans'],
            'updatedesc' => ['investment_plans', 'investmentplans'],
            'mywallets' => ['walletaddress', 'walletaddresses'],
            'selectwallet' => ['walletaddress', 'walletaddresses'],
            'addwallet' => ['walletaddress', 'walletaddresses'],
            'deletewallet' => ['walletaddress', 'walletaddresses'],
            'mystocks' => ['stock', 'stocks'],
            'addstock' => ['stock', 'stocks'],
            'processstock' => ['stock', 'stocks'],
            'insertstock' => ['stock', 'stocks'],
            'deletestock' => ['stock', 'stocks'],
            'selectfaq' => ['faqs', 'faq'],
            'faqcontainer' => ['faqs', 'faq'],
            'insertfaq' => ['faqs', 'faq'],
            'deletefaq' => ['faqs', 'faq'],
            'verification' => ['VerificationDocs', 'verification'],
            'addverificationlevel' => ['verification', 'VerificationDocs'],
            'deleteverification' => ['verification', 'VerificationDocs'],
            'deleteverificationdoc' => ['VerificationDocs', 'verification'],
            'resources' => ['resources'],
            'chat' => ['chat', 'chats'],
            'sendchat' => ['chats', 'chat'],
            'pages' => ['pages'],
            'editcontent' => ['pages'],
            'myagents' => ['agent'],
            'agentprofile' => ['agent'],
            'myclients' => ['investors'],
            'mytraders' => ['copy_traders'],
            'selecttraders' => ['copy_traders'],
        ];

        $candidates = $aliases[$module] ?? ($configured ? [$configured] : []);

        if ($configured && !in_array($configured, $candidates, true)) {
            array_unshift($candidates, $configured);
        }

        foreach (array_unique($candidates) as $candidate) {
            if (Schema::hasTable($candidate)) {
                return $candidate;
            }
        }

        return null;
    }

    private function orderColumn(string $table): string
    {
        return Schema::hasColumn($table, 'id') ? 'id' : Schema::getColumnListing($table)[0] ?? 'id';
    }

    private function countFirstExisting(array $tables): int
    {
        foreach ($tables as $table) {
            if ($this->tableExists($table)) {
                return $this->countTable($table);
            }
        }

        return 0;
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
