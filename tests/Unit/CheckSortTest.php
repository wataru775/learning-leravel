<?php

namespace Tests\Unit;

use Tests\TestCase;

/**
 * setupなどの実行順番の確認試験
 */
class CheckSortTest extends TestCase {
    public static function setUpBeforeClass(): void {
        print "CheckSortTest@setUpBeforeClass\n";
    }

    public static function tearDownAfterClass(): void {
        print "CheckSortTest@tearDownAfterClass\n";
    }

    protected function setUp(): void {
        print "CheckSortTest@setUp\n";
    }

    protected function tearDown(): void {
        print "CheckSortTest@tearDown\n";
    }

    public function test_a() {
        print " * CheckSortTest@test_a\n";
        $this->assertTrue(true);
    }

    public function test_b(){
        print " * CheckSortTest@test_b\n";
        $this->assertTrue(true);
    }

    public function test_c(){
        print " * CheckSortTest@test_c\n";
        $this->assertTrue(true);
    }
}
