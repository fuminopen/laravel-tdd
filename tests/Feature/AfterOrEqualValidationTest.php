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
            'start' => (new Carbon())->format('Y/m/d H:i'),
            'end' => (new Carbon())->format('Y/m/d H:i'),
        ];

        $this->get('/after-or-equal', $param)->assertSessionHasErrors('start');
    }
}
