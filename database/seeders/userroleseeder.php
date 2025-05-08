<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class userroleseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

$admin= Role::createOrFirst(['name'=>'admin']);
$user= Role::createOrFirst(['name'=>'user']);

$admin1 = User::find(1);

$admin1->assignRole('admin');


    }
}
