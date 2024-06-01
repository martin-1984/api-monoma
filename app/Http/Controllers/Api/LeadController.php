<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadResource;
use App\Repositories\LeadRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    protected $leadRepository;

    public function __construct(LeadRepositoryInterface $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    public function create(LeadRequest $request)
    {
        try {
            $lead = $this->leadRepository->create(Auth::user(), $request->all());

            return $this->sendSuccess(new LeadResource($lead), 201);

        } catch (\Exception $e) {
            return $this->sendError([$e->getMessage()], 400);
        }
    }

    public function show($id)
    {
        try {
            $lead = $this->leadRepository->find(Auth::user(), $id);

            if (!$lead) {
                return $this->sendError(['Lead not found'], 404);
            }

            return $this->sendSuccess(new LeadResource($lead), 200);

        } catch (\Exception $e) {
            return $this->sendError([$e->getMessage()], 400);
        }
    }

    public function all()
    {
        try {
            $leads = $this->leadRepository->all(Auth::user());
            return $this->sendSuccess(LeadResource::collection($leads), 200);

        } catch (\Exception $e) {
            return $this->sendError([$e->getMessage()], 400);
        }
    }
}
