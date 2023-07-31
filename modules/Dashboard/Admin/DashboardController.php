<?php
namespace Modules\Dashboard\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Modules\AdminController;
use Modules\Booking\Models\Booking;

class DashboardController extends AdminController
{
    public function index()
    {
        $user = Auth::user();
        if($user->role_id==1)
        $recentBookings = Booking::getRecentAllBookings();
        else
            $recentBookings = Booking::getRecentBookings();
        $f = strtotime('monday this week');
        $data = [
            'recent_bookings'    => $recentBookings,
            'top_cards'          => Booking::getTopCardsReport(),
            'earning_chart_data' => Booking::getDashboardChartData($f, time())
        ];
        return view('Dashboard::index', $data);
    }

    public function reloadChart(Request $request)
    {
        $chart = $request->input('chart');
        switch ($chart) {
            case "earning":
                $from = $request->input('from');
                $to = $request->input('to');
                return $this->sendSuccess([
                    'data' => Booking::getDashboardChartData(strtotime($from), strtotime($to))
                ]);
                break;
        }
    }
}
