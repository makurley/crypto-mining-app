<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MinerData;

class MinerDataController extends Controller
{
    // Show list of miners
    public function index()
    {
        // Retrieve all miners, sorted by the latest
        $miners = MinerData::latest()->paginate(10);

        // Return a view with the miners data
        return view('admin.miner-data.index', compact('miners'));
    }

    // Show form to create new miner data
    public function create()
    {
        return view('admin.miner-data.create');  // View for the create form
    }

    // Store new miner data
    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'miner_location' => 'required|string|max:255',
            'miner_ip' => 'required|ip',
            'up_time' => 'required|string|max:10',
            'status' => 'required|in:active,down,cooling',
        ]);

        // Save to database
        MinerData::create([
            'miner_location' => $request->miner_location,
            'miner_ip' => $request->miner_ip,
            'up_time' => $request->up_time,
            'status' => $request->status,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.miner-data.create')->with('success', 'Miner data added successfully!');
    }

    // Show form to edit a miner record
    public function edit($id)
    {
        // Retrieve the miner data
        $miner = MinerData::findOrFail($id);

        // Return the view for editing
        return view('admin.miner-data.edit', compact('miner'));
    }

    // Update existing miner record
    public function update(Request $request, $id)
    {
        // Validate the form input
        $request->validate([
            'miner_location' => 'required|string|max:255',
            'miner_ip' => 'required|ip',
            'up_time' => 'required',
            'status' => 'required|in:active,down,cooling',
        ]);

        // Find the miner record
        $miner = MinerData::findOrFail($id);

        // Update the record
        $miner->update([
            'miner_location' => $request->miner_location,
            'miner_ip' => $request->miner_ip,
            'up_time' => $request->up_time,
            'status' => $request->status,
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.miner-data.edit', $id)->with('success', 'Miner data updated successfully!');
    }
}
