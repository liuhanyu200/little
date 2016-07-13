#基于Apache，php和sqlite在CI框架下的网站

[欢迎访问我的Github，资料都在里面哟！][1]

[上一篇，Git同步仓库操作，欢迎大家访问哟 -。 -][2]

[原文地址][3]

标签：PHP  SQLite  CI

> * 1.把连接数据库模块封装为一个独立的类
```
class Sqlite extends SQLite3
{
    function __construct()
    {
        /* 数据库文件可以命名为 .db .sql ... 只是.sql可以看到实体文件 */
        $this->open('./application/sql/server.sql');
    }
}
```

> * 2.调用该类到模型（Model）下面对数据库进行操作
```
$this->load->library('sqlite');
$test = new Sqlite();
/* exec()无结果的sql执行函数适用于创建表，更新，插入..不需要返回值的sql语句 */
$sql = '...'; /* sql语句 */
$test->exec($sql);
```
```
/* sql语句的另一种写法--很好用 */
$sql = <<<EOF
select * from user where username = $username;
EOF;
```
> * 查询到多个数据怎么获取呢？
```
$this->load->library('sqlite');
$test = new Sqlite();
$sql = '...';
$result = $test->query($sql);
while($row = $result->fetchArray(SQLITE3_ASSOC)) {
    // 输出要的数据
    echo $row['username'];
    echo $row['password'];
}
```
> * 3.网站的适应性缩放和垂直居中问题
```
// 垂直居中 - 1（外层div设置table，内部元素设置table-cell）
parent{
    display:table;
}
children{
    display:table-cell;
    vertical-align:middle;
}
// 垂直居中 - 2（设置margin，浮动，一般在企业中不常用）
// 适应性缩放 (给相关元素设置下面属性)
max-width:;
max-height:;
min-width:;
min-height:;
```
> * 4.CI框架下模型书写规范
```
class Model_name extends CI_Model {
    public function __construct()
    {
        // 必须继承父类
        parent::__construct()
        // 加载相关库
        $this->load->library('sqlite');
        $this->load->library('session');
    }
}
```
> * 5.同理，CI框架下控制器书写规范
```
class Model_name extends CI_Controller {
    public function __construct()
    {
        // 必须继承父类
        parent::__construct()
        // 加载相关库
        $this->load->model('server/server_mod');
    }
}
```
> * 6.Ajax的封装
```
(function() {
	oUser.onkeyup = function() {
		var str = this.value;
		if (str=="") {
			oTxt.innerHTML="";
			return;
		} 
		if (window.XMLHttpRequest) {
			// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
			xmlhttp=new XMLHttpRequest();
		} else {
			// IE6, IE5 浏览器执行代码
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState==4 && xmlhttp.status==200) {
			// xmlhttp.responseText来自请求的函数return或者echo
				if (xmlhttp.responseText === '1') {
					oTxt.innerHTML = '恭喜！该用户名可用';
					oTxt.style.color = 'green';
					document.getElementById("reg").disabled = false;
				}
				if (xmlhttp.responseText === '0') {
					oTxt.innerHTML = '您输入的用户名被占用了哟！换一个试试';
					oTxt.style.color = 'red';
					document.getElementById("reg").disabled = true;
				}
			}
		}
		xmlhttp.open("GET","/server/index.php/login/check_user?q="+str,true);
		xmlhttp.send();
		};
})();
```
> * 一些经常忘记的地方
```
// CI框架下面的路由--配置文件最好这么写，放到服务器根目录
...
<link rel="stylesheet" type="text/css" href="/server/style/main.css">
...
<script src="/server/js/main.js"></script>
...
// Ajax GET POST 路由
...
<a id="delete" href="=/server/index.php/login/del?username<?php echo $row['username'];?>">删除</a>
...
// 这个请求路由按照CI框架直接可以访问控制器的确定方法
...
xmlhttp.open("GET","/server/index.php/login/check_user?q="+str,true);
...
// 引入外部css 插在头部
...
<link rel="stylesheet" type="text/css" href="/server/style/main.css">
...
// 引入外部js 插在尾部
<script src="/server/js/main.js"></script>
```
> * 路由引发的思考
CI框架里面的页面切换方法：
```
<a href="/server/index.php/login/turn_to_register"></a> //view(a标签路由访问)
function turn_to_register()
{   
    //controller(视图切换)
    $this->load->view('server/register_view');
}
```
> * 如何消除`php`的`udefined`错误警告：
可以看看[这篇帖子][4]
```
// 下面都可以解决
if(isset($test)) {//输出}
if(empty($test)) {//输出}
if(is_null($test)) {//输出}
```

> * `php`登陆注销页面之间的逻辑怎么写？
登陆的时候和注销的时候出了点问题
假设：
登陆成功后的页面为 1
注销成功后的页面为 2
其他页面为3...
接下来 我在3... 注销页面 --- 刷新1 后--- 再刷新3...--- 3...又登陆了
然后如果我刷新2---再去刷新3的话---3又注销了
也就是说，1,2两个`页面刷新`会`重复请求`，1是请求登陆，添加session
2是请求注销，删除session
```
//解决办法很简单凡是有请求的页面都加一个重定向
// 详细见CI的辅助函数
redirect('//相对url');

```


[下一篇，如何在CI框架下封装自己的数据集合？][5]


  [1]: https://github.com/ab233/little
  [2]: https://www.zybuluo.com/klci/note/430070
  [3]: https://www.zybuluo.com/klci/note/430232
  [4]: http://www.jb51.net/article/25032.htm
  [5]: http://www.baidu.com