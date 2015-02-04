<?php
namespace jvdh\ReferenceSpotting\Tests;

use jvdh\ReferenceSpotting\Spotter;

class ReferencesComparatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getReferenceData
     *
     * @param mixed $var1
     * @param mixed $var2
     */
    public function testIsReference(&$var1, &$var2)
    {
        $s = new Spotter();
        $this->assertTrue($s->isReference($var1, $var2));
    }

    /**
     * @dataProvider getReferenceData
     *
     * @param mixed $var1
     * @param mixed $var2
     */
    public function testIsNotReference($var1, $var2)
    {
        $s = new Spotter();
        $this->assertFalse($s->isReference($var1, $var2));
    }


    public function getReferenceData()
    {
        $data = array();

        $a = null;
        $b = &$a;
        $data[] = array(&$a, &$b);

        $c = array(1, 2);
        $d = &$c;
        $data[] = array(&$c, &$d);

        $e = new \stdClass();
        $f = &$e;
        $data[] = array(&$e, &$f);

        $g = new \DateTime();
        $h = &$g;
        $data[] = array(&$g, &$h);

        return $data;
    }

    public function testRelatedButNotReferencesObjects()
    {
        $a = new \stdClass();
        $b = $a;

        $s = new Spotter();
        $this->assertFalse($s->isReference($a, $b));
    }
}
