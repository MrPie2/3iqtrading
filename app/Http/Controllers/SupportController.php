<?php
namespace App\Http\Controllers;

use App\Models\WhatsAppSetting;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $whatsapp = WhatsAppSetting::query()->value('Phone');

        return view('dashboard.support.index', [
            'whatsapp' => $whatsapp,
            'investor' => Auth::guard('investor')->user(),
        ]);
    }
}