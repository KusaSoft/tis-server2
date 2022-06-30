<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertFalse;
use function PHPUnit\Framework\assertTrue;

class HelpersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_seSolapan1(){
        assertTrue(seSolapan("11:15","15:45","11:15","15:45"));
    }
    public function test_seSolapan2(){
        assertTrue(seSolapan("12:45","14:15","11:15","15:45"));
    }
    public function test_seSolapan3(){
        assertTrue(seSolapan("11:15","12:45","11:15","15:45"));
    }
    public function test_seSolapan4(){
        assertTrue(seSolapan("14:15","15:45","11:15","15:45"));
    }
    public function test_seSolapan5(){
        assertTrue(seSolapan("9:45","12:45","11:15","15:45"));
    }
    public function test_seSolapan6(){
        assertTrue(seSolapan("14:15","17:15","11:15","15:45"));
    }
    public function test_seSolapan7(){
        assertTrue(seSolapan("9:45","17:15","11:15","15:45"));
    }
    public function test_seSolapan8(){
        assertFalse(seSolapan("9:45","11:15","11:15","15:45"));
    }
    public function test_seSolapan9(){
        assertFalse(seSolapan("15:45","17:15","11:15","15:45"));
    }
    public function test_seSolapan10(){
        assertFalse(seSolapan("6:45","9:45","11:15","15:45"));
    }
    public function test_seSolapan11(){
        assertFalse(seSolapan("17:15","20:15","11:15","15:45"));
    }
    public function test_seSolapan12(){
        assertTrue(seSolapan("15:45","17:15","15:45","17:15"));
    }
}
