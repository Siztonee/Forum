<?php

namespace App\Http\Controllers\Staff\Panel;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PanelController extends Controller
{
    public function index()
    {
        return view('staff.panel.panel');
    }

    public function getRegistrationStats(Request $request)
    {
        $period = $request->get('period', 'day');
        $now = Carbon::now();
        
        $query = User::query();
        
        switch ($period) {
            case 'day':
                $start = $now->copy()->startOfDay();
                $query->where('created_at', '>=', $start)
                    ->selectRaw('DATE_FORMAT(created_at, "%H:00") as label, COUNT(*) as count')
                    ->groupBy('label');
                break;
            
            case 'week':
                $start = $now->copy()->startOfWeek();
                $query->where('created_at', '>=', $start)
                    ->selectRaw('DATE(created_at) as label, COUNT(*) as count')
                    ->groupBy('label');
                break;
            
            case 'month':
                $start = $now->copy()->startOfMonth();
                $query->where('created_at', '>=', $start)
                    ->selectRaw('DATE(created_at) as label, COUNT(*) as count')
                    ->groupBy('label');
                break;
            
            case 'year':
                $start = $now->copy()->startOfYear();
                $query->where('created_at', '>=', $start)
                    ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as count')
                    ->groupBy('label');
                break;
            
            case 'all':
                $query->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as label, COUNT(*) as count')
                    ->groupBy('label');
                break;
        }
        
        return response()->json($query->get());
    }
}
