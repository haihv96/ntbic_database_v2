<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RawProfile\RawProfileInterface;
use App\Http\Requests\UpdateRawProfile;
use Mockery\Exception;

class RawProfileController extends Controller
{
    protected $rawProfileRepository;

    public function __construct(RawProfileInterface $rawProfileRepository)
    {
        $this->rawProfileRepository = $rawProfileRepository;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        if ($request->ajax()) {
            return response()->json([
                'data' => view('management.raw-profiles.list', [
                    'rawProfiles' => $this->rawProfileRepository->where('name', 'like', "%$search%")->paginate(10)
                ])->render(),
            ], 200);
        } else {
            return view('management.raw-profiles.index', [
                'rawProfiles' => $this->rawProfileRepository->paginate(10)
            ]);
        }
    }

    public function show(Request $request, $id)
    {
        return response()->json([
            'data' => view('management.raw-profiles.show', [
                'rawProfile' => $this->rawProfileRepository->find($id)
            ])->render(),
        ], 200);
    }

    public function edit(Request $request, $id)
    {
        return response()->json([
            'data' => view('management.raw-profiles.edit', [
                'rawProfile' => $this->rawProfileRepository->find($id)
            ])->render(),
        ], 200);
    }

    public function update(UpdateRawProfile $request, $id)
    {
        try {
            $rawProfile = $this->rawProfileRepository->update($id, $request->all());
            return response()->json([
                'data' => view('management.raw-profiles.item', [
                    'rawProfile' => $rawProfile
                ])->render(),
                'message' => 'Update raw profile successful!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Update raw profile error!'
            ], 500);
        }
    }

    public function destroy($ids)
    {
        $ids = json_decode($ids);
        try {
            $this->rawProfileRepository->delete($ids);
            return response()->json([
                'data' => null,
                'message' => 'Delete raw profile successful!'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'data' => null,
                'message' => 'Delete raw profile error!'
            ], 500);
        }
    }
}
