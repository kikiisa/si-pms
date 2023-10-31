<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\DurasiService;
class DurasiTest extends TestCase
{
    private $durasi;
    public function __construct()
    {
        $this->durasi = new DurasiService();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
       $this->assertEquals($this->durasi->totalHari('2022-10-01','2022-10-03'), 3);
    }
}
