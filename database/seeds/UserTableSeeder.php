<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker=Faker::create();
        for($i=0; $i<30; $i++){

        \DB::table('users')->insert(array(
            'name' => $faker->firstname,
            'email' => $faker->unique()->email,
            'password' => \Hash::make('123')
        ));}
    }
}