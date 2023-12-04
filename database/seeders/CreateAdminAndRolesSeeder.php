<?php



namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use App\Models\User;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;



class CreateAdminAndRolesSeeder extends Seeder

{

    /**

     * Run the database seeds.

     */

    public function run(): void

    {

        // Need to insert into Person table instead and assign roles to Person
        $user = User::create([

            'name' => 'Tardik Savani',

            'email' => 'test2@gmail.com',

            'password' => bcrypt('123456')

        ]);


        Role::create(['name'=>'Member']);
        Role::create(['name'=>'Primary']);
        Role::create(['name'=> 'Secondary']);
        $role = Role::create(['name' => 'Admin']);
        Role::create(['name'=>'HelpDesk']);



        $user->assignRole([$role->id]);

    }

}
