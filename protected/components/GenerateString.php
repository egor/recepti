<?php
/**
 * GenerateString
 *
 * @author egorik
 */
class GenerateString
{
    function generateIdString($id, $length = 10)
    {
        $chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
        $numChars = strlen($chars);
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        return $id.$string;
    }
}

?>
