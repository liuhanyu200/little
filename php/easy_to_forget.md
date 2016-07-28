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

> 



