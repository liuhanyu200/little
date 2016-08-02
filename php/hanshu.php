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

recursion(-200);