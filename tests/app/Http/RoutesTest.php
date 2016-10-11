<?php

class RoutesTest extends TestCase{

    public function testGetPayMethod(){
        $response = $this->call('GET', 'pay_method');
        $this->assertEquals(200, $response->status());
    }

}

?>