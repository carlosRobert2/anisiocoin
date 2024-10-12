<?php

//namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
//use Illuminate\Database\Seeder;

//class WalletSeeder extends Seeder

//{
    /**
     * Run the database seeds.                 obs.: já estava comentado
     */
  //  public function run(): void
    //{
        //
    //}
//}   

/*namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // Tente encontrar a usuária Ariana
        $admin = User::where('email', 'ariana@example.com')->first();

        // Se ela não existir, crie-a
        if (!$admin) {
            $admin = User::create([
                'name' => 'Ariana',
                'email' => 'arianaquaresma25@gmail.com',
                'password' => Hash::make('passwordbeta123'), // Lembre-se de mudar isso para um valor seguro
            ]);
        }

        // Crie a carteira para a administradora Ariana
        Wallet::create([
            'user_id' => $admin->id,
            'balance' => 1000,
        ]);
    }
} */



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;

class WalletSeeder extends Seeder
{
    public function run()
    {
        // Tente encontrar a usuária Ariana
        $admin = User::where('email', 'arianaquaresma25@gmail.com')->first();

        // Se ela não existir, crie-a
        if (!$admin) {
            $admin = User::create([
                'name' => 'Ariana',
                'email' => 'arianaquaresma25@gmail.com',
                'password' => Hash::make('passwordbeta123'), // Lembre-se de mudar isso para um valor seguro
            ]);
        }

        // Verifica se a carteira de Ariana já existe e cria com 1000 anisiocoin se não existir
        Wallet::firstOrCreate(
            ['user_id' => $admin->id],
            ['balance' => 1000]
        );

        // Itera por todos os usuários e cria uma carteira para cada um se ainda não existir
        $users = User::all();

        foreach ($users as $user) {
            Wallet::firstOrCreate(
                ['user_id' => $user->id],
                ['balance' => 0] // Saldo inicial zero para os outros usuários
            );
        }
    }
}


