<?php
namespace Modules\Configuration\Repositories\User;

interface UserRepository
{
    public function all();
    public function lists();
    public function accessModules($id);
    public function destroy($id);
    public function changeStatus($id);
}