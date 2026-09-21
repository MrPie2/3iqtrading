<?php
namespace App\Http\Controllers;
use App\Models\WhatsAppSetting;
class SupportController extends Controller
{
    public function index(){
        $whatsapp=WhatsAppSetting::query()->value('Phone');
        return view('support.index',compact('whatsapp'));
    }
}
