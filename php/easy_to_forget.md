## php中容易忘结的知识点

> 数组

```php
// key 可以是 integer 或者 string. value可以是任意类型。 
<?php
$array = array(
	"foo" => "bar",
	"bar" => "foo"
);

// 5.4 以后
$array = [
	"foo" => "bar",
  	"bar" => "foo"
];

// 方括号 和 花括号可以互相替换来访问数组单元
// 别忘记 ""
$array["foo"] === $array{"foo"} 
```

> 字符串

1.单引号

```php
'hello world'
```

2.双引号

```php
"hello world"
```

3.heredoc语法结构

```php
$sql = <<<EOT
	select * from user where username=$username
EOT;
// 注意 heredoc不能用来初始化类的属性
// 下面这个就是错误的例子
<?php
  class foo {
  	  public $bar = <<<EOT
  	  hello world
EOT;
}
```

4.nowdoc语法结构

和heredoc相似，nowdoc就相当于单引号，里面的内容不进行解释，而heredoc相当于双引号，内部的内容要进行解释。

```php
<?php
echo <<<'EOT'
  I am printing some {$foo->bar[1]}
EOT;
>
```

> 花括号语法

任何具有string表达式的标量变量，数组单元或对象属性都可以使用此语法。只需简单的像在string以外的地方写出表达式，然后用花括号{和}把它括起来即可。

> foreach

```php
foreach (array_exception as $value)
  	statement
foreach (array_exception as $key => $value)
  	statement
```

当`foreach`开始执行时，数组内部的指针会自动指向第一个单元，这意味着不需要在`foreach`循环之前调用reset()。

```php
<?php
$arr = array(1, 2, 3, 4);
// 可以很容易地通过在$value之前加上&来修改数组元素
// 此方法将以引用赋值而不是拷贝一个值
foreach ($arr as &$value) {
  	$value = $value * 2;
}
unset($value); // 取消引用
```

> arrary_key_exists()

`array_key_exists`——检查给定的键名或索引是否存在于数组中，存在返回TRUE，失败返回FALSE。`key`可以是任何能作为数组索引的值。`array_key_exists()`也可以用于对象。可以接收`array`

> 



