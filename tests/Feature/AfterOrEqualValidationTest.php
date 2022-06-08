<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AfterOrEqualValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_after_or_equal_correctly_working()
    {
        $param = [
            'dates' => [
                [
                    'start' => (new Carbon())->addDay()->format('Y/m/d H:i'),
                    'end' => (new Carbon())->addDays(2)->format('Y/m/d H:i'),
                ]
            ]
        ];

         $this->get(route('validation', $param))->assertSessionHasNoErrors('info.0.start');
    }
}
