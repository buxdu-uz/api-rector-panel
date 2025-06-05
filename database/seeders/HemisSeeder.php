<?php

namespace Database\Seeders;

use App\Domain\Faculties\Models\Faculty;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HemisSeeder extends Seeder
{
    /**
     * @var mixed|Client
     */
    public mixed $clients;

    /**
     * @var mixed|string[]
     */
    public mixed $headers;

    public function __construct()
    {
        $this->clients = new Client();
        $this->headers = [
            'Authorization' => 'Bearer ' . config('hemis.api_key'),
            'Accept' => 'application/json',
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command?->info('Seeding faculties...');
        $this->faculties();
    }

    public function faculties()
    {
        $request = new Request('GET', config('hemis.host').'data/department-list?_structure_type=11&limit='.config('hemis.limit'), $this->headers);
        $res = $this->clients->sendAsync($request)->wait();
        $resBody = json_decode($res->getBody());

        if (isset($resBody->data->pagination->pageCount) && isset($resBody->data->items)) {
            foreach ($resBody->data->items as $dt) {
                if (strpos($dt->name, 'nofaol') === false) {
                    Faculty::updateOrCreate([
                        'id' => $dt->id,
                    ],[
                        'name' => $dt->name,
                        'code' => $dt->code,
                    ]);
                }
            }

            // Loop through the remaining pages
            for ($i = 2; $i <= $resBody->data->pagination->pageCount; $i++) {
                $request = new Request(
                    'GET',
                    config('hemis.host') . 'data/department-list?_structure_type=11&limit='.config('hemis.limit').'&page=' . $i,
                    $this->headers
                );
                $res = $this->clients->sendAsync($request)->wait();
                $resBody = json_decode($res->getBody());

                // Check if the request was successful
                if (isset($resBody->data->items)) {
                    foreach ($resBody->data->items as $dt) {
                        if (strpos($dt->name, 'nofaol') === false) {
                            Faculty::updateOrCreate([
                                'id' => $dt->id,
                            ],[
                                'name' => $dt->name,
                                'code' => $dt->code,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
