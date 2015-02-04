<?php
namespace jvdh\ReferenceSpotting;

class Spotter
{
    /**
     * @param mixed $var1
     * @param mixed $var2
     * @return bool
     */
    public function isReference(&$var1, &$var2)
    {
        $same = false;

        if ($var1 === $var2) {
            $originalVar1 = $var1;

            do {
                $newVar1 = uniqid();
            } while ($var1 == $newVar1);

            $var1 = $newVar1;

            if ($var2 === $newVar1) {
                $same = true;
            }

            $var1 = $originalVar1;
        }

        return $same;
    }
}