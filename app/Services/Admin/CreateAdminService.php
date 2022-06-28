<?php

namespace App\Services\Admin;

use App\Models\Admin;

class CreateAdminService
{
    public function execute(AdminDto $dto): Admin
    {
        $admin = Admin::where('email', $dto->email)->first();

        if ($admin instanceof Admin) {
            throw new AdminExistsByEmail(ExceptionMessages::EXISTS_BY_EMAIL());
        }

        $admin = new Admin();
        $admin->setName($dto->name);
        $admin->setEmail($dto->email);
        $admin->setPassword($dto->password);
        $admin->setDisabled($dto->disabled);
        $admin->setSuperUser($dto->superUser);
        $admin->setSubdivision($dto->subdivision_id);
        $admin->setApiToken();
        $admin->save();

        return $admin;
    }
}
