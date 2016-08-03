<?php

// 用户自定义函数
function foo($arg1, $arg2, $arg3, /* ..., */ $argn)
{
	echo "Example function.\n";
	return $arg1;
}

// 简单的递归
function recursion($a)
{
	if ($a < 200)
    {
        echo $a."<br>";
        recursion($a + 1);
    }
}

// recursion(-200);

// 通过引用传递参数, 可以改变参数的值
function add_some_extra(&$string)
{
    $string .= 'and something else.';
}
//$str = 'hello world,';
//add_some_extra($str);
//echo $str; // hello world,and something else.

// 不传值就用默认值
function makecoffee($type = "cappuccino")
{
    return "Making a cup of $type.<br>";
}
//echo makecoffee('milk');
//echo makecoffee();
//echo makecoffee(null);

// 使用非标量类型作为默认参数
// 默认值 必须是常量表达式，不能是变量，类成员，或者函数调用，任何默认参数必须放在非默认蚕食的右侧
function makecoffee_v2($types = array("cappuccion"), $coffeeMaker = NULL)
{
    $devides = is_null($coffeeMaker) ? "hands" : $coffeeMaker;
    return "Making a cup of ".join(", ", $types)."width $devides.\n";
}
//echo makecoffee_v2(array(1,1,2,3,4,5,6,7,7,5,4,34,2,32,32,4,5,2,32,3,23,2,4),'zero');

// 参数注意换位置， 但是测试没出问题啊！
function makeyogurt($type = "acidophilus", $flavour)
{
    return "Making a bowl of $type $flavour.\n";
}
//echo makeyogurt("raspberry");

function foo_1(&$var)
{
    $var = & $GLOBALS["baz"];
}
// foo($var);

$example = function() {
    var_dump("hello world");
};

function __autoload($class_name)
{
    require_once $class_name . '.php';
}
//$obj = new MyClass1();
//$obj = new MyClass2();

function __construct()
{
    //
}






