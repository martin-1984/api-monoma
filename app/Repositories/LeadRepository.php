<?php

namespace App\Repositories;

use App\Models\Lead;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class LeadRepository implements LeadRepositoryInterface
{
    public function all(User $user)
    {
        /*
        return Cache::remember('all_leads', 60, function () {
            return Lead::all();
        });
        */


        if ($user->role == 'agent') {
            return Lead::where('owner', $user->id)->get();
        }
        return Lead::all();
    }

    public function find(User $user, $id)
    {
        /*
        return Cache::remember('lead_' . $id, 60, function () use ($id) {
            return Lead::find($id);
        });
        */

        if ($user->role == 'agent') {
            return Lead::where('owner', $user->id)->find($id);
        }
        return Lead::find($id);
    }

    public function create(User $user, array $data)
    {
        DB::beginTransaction();
        try {
            $data['created_by'] = $user->id;

            $lead = Lead::create($data);
            DB::commit();
            return $lead;
        } catch (\Exception $e) {
            DB::rollback();
            return throw new Exception($e->getMessage());
        }
    }

    public function update(array $data, $id)
    {
        $lead = Lead::find($id);
        $lead->update($data);
        return $lead;
    }

    public function delete($id)
    {
        return Lead::destroy($id);
    }
}
