<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $message = new Message();
            $message->sender_id = rand(1, 10);
            $message->receiver_id = rand(1, 10);

            $message->message = fake()-> paragraph(2);
            $message->save();
        }
    }
}
