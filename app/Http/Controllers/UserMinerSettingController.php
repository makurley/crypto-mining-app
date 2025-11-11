<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MinerData;

class UserMinerSettingController extends Controller
{
   public function showMinerSettings()
{
    $miners = MinerData::all();
    $user = auth()->user(); // Fetch the current logged-in user
    return view('user.miners-setting.minersetting', compact('miners', 'user'));
}

    public function saveMinerSettings(Request $request)
    {
        $user = auth()->user();
        
        $user->server_status = $request->has('server_status') ? 1 : 0;
        $user->miner_location = $request->miner_location;
        $user->miner_ip = $request->miner_ip;

        $user->save();

        return redirect()->back()->with('success', 'Miner settings updated successfully.');
    }
  public function getMinerIpByLocation(Request $request)
{
    $minerLocation = $request->location;

    // Fetch miner details by location
    $miner = MinerData::where('miner_location', $minerLocation)->first();

    if ($miner) {
        return response()->json([
            'miner_ip' => $miner->miner_ip,
            'up_time' => $miner->up_time, // Assuming `up_time` is a column in the miner_data table
            'status' => $miner->status    // Assuming `status` is a column in the miner_data table
        ]);
    }

    return response()->json([
        'miner_ip' => null,
        'up_time' => null,
        'status' => null
    ]);
}


}
