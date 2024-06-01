<?php

namespace App\Repositories;

use App\Models\User;

interface LeadRepositoryInterface
{
    public function all(User $user);
    public function find(User $user, $id);
    public function create(User $user, array $data);
    public function update(array $data, $id);
    public function delete($id);
}
