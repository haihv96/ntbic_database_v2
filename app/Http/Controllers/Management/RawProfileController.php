<?php

namespace App\Http\Controllers\Management;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\RawProfile\RawProfileInterface;
use App\Http\Resources\RawProfileResource;

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
            return json_encode([
                'error' => false,
                'data' => view('management.profiles.list', [
                    'rawProfiles' => $this->rawProfileRepository->where('name', 'like', "%$search%")->paginate(10)
                ])->render(),
                'status' => 200
            ]);
        } else {
            return view('management.profiles.index', [
                'rawProfiles' => $this->rawProfileRepository->paginate(10)
            ]);
        }
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
    }
}
