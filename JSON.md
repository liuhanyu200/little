# JSON

标签（空格分隔）： JSON JavaScript PHP

---

本文的[大多内容来源于这][1]篇文章。

[我的Github][2]，欢迎访问！

关于json,需要理解的是，它只是一种数据格式，不是一种编程语言。很多编程语言都有针对JSON的解析器和序列化器。

##javascript中的JSON
`注意：`
> json中可以表示字符串，数值，null。但不支持JavaScript中的undefined，NaN，Infinity，-Infinity和undefined
> json对象的键名必须放在双引号里面，不能使用单引号
> 数组或对象最后一个成员的后面，不能加逗号

`合格的JSON值：`
```javascript
["one", "two", "three"]

{ "one": 1, "two": 2, "three": 3 }

{"names": ["张三", "李四"] }

[ { "name": "张三"}, {"name": "李四"} ]
```
`不合格的JSON值：`
```javascript
{ name: "张三", 'age': 32 }  // 属性名必须使用双引号

[32, 64, 128, 0xFFF] // 不能使用十六进制值

{ "name": "张三", "age": undefined } // 不能使用undefined

{ "name": "张三",
  "birthday": new Date('Fri, 26 Aug 2011 07:13:10 GMT'),
  "getName": function() {
      return this.name;
  }
} // 不能使用函数和日期对象
```
> * 需要注意的是，空数组和空对象都是合格的JSON值，null本身也是一个合格的JSON值。

`JSON.stringify()`
该方法用于将一个值序列化为JSON字符串，该值可以被JSON.parse()还原
```javascript
JSON.stringify('abc') // ""abc""
JSON.stringify(1) // "1"
JSON.stringify(false) // "false"
JSON.stringify([]) // "[]"
JSON.stringify({}) // "{}"

JSON.stringify([1, "false", false])
// '[1,"false",false]'

JSON.stringify({ name: "张三" })
// '{"name":"张三"}'

//如果原始对象中，有一个成员的值是undefined、函数或XML对象，这个成  员会被省略。如果数组的成员是undefined、函数或XML对象，则这些值被  转成null。

JSON.stringify({
  f: function(){},
  a: [ function(){}, undefined ]
});
// "{"a": [null,null]}"

JSON.stringify(/foo/) // "{}" 正则会变成空对象

// JSON.stringify方法会忽略对象的不可遍历属性。
var obj = {};
Object.defineProperties(obj, {
  'foo': {
    value: 1,
    enumerable: true
  },
  'bar': {
    value: 2,
    enumerable: false
  }
});

JSON.stringify(obj); // {"foo":1}
```

`JSON.parse()`
该方法用于将JSON字符串解析为JavaScript数组
```javascript
JSON.parse('{}') // {}
JSON.parse('true') // true
JSON.parse('"foo"') // "foo"
JSON.parse('[1, 5, "false"]') // [1, 5, "false"]
JSON.parse('null') // null

var o = JSON.parse('{"name": "张三"}');
o.name // 张三

// JSON.parse方法可以接受一个处理函数，用法与JSON.stringify方法类似。
function f(key, value) {
  if (key === ''){
    return value;
  }
  if (key === 'a') {
    return value + 10;
  }
}

var o = JSON.parse('{"a":1,"b":2}', f);
o.a // 11
o.b // undefined
```
##php中的JSON
`json_decode()`
对 JSON 格式的字符串进行解码，只能处理utf-8格式的字符串
```php
<?php
$arr = array ('a'=>1,'b'=>2,'c'=>3,'d'=>4,'e'=>5);
echo json_encode($arr);
// {"a":1,"b":2,"c":3,"d":4,"e":5}
?>
```
`json_encode`
```php
<?php
$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

var_dump(json_decode($json));
var_dump(json_decode($json, true));

// 输出
object(stdClass)#1 (5) {
    ["a"] => int(1)
    ["b"] => int(2)
    ["c"] => int(3)
    ["d"] => int(4)
    ["e"] => int(5)
}

array(5) {
    ["a"] => int(1)
    ["b"] => int(2)
    ["c"] => int(3)
    ["d"] => int(4)
    ["e"] => int(5)
}
?>
```


  [1]: http://javascript.ruanyifeng.com/stdlib/json.html
  [2]: https://github.com/liuhanyu200