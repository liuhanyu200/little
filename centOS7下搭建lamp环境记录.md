#  centOS 7 下搭建lamp环境记录

标签 ： centOS PHP SQLite

---

### 安装centOS到虚拟机

---

**凡事都没有绝对，日新月异的软件包软件源，我也不知道下面的那一步在谁的机子上会出什么问题，反正遇到问题的时候，别气馁就行了，网上总能找到答案，是在找不到答案也没关系，换一种选择有些时候也是可以的。题主在搞这些的时候也是一路折腾的要死不得活，坚持就好！**

---

> * 1.下载对应版本的.ISO，例如：CentOS-7-x86_64-Minimal-1511.iso
> * 2.按照安装顺序一路点下去，设置用户名，密码（这个时候的用户为普通用户）
> * 3.切换高级用户
```
passwd 回车
// 新密码，再次输入，OK
```
> * 4.网络修改
```
/etc/sysconfig/network-scripts/
进入以上目录查找ifcfg-ens...
vi ifcfg-ens...
ONBOOT=no 改成ONBOOT=yes
service network restart
```
> * 5.更新软件包
```
yum update
```
> * 6.安装apache
```
yum install httpd // 在centOS7下Apache叫httpd
```
> * 7.安装php全家桶([点这里][1])
```
rpm -Uvh https://mirror.webtatic.com/yum/el7/epel-release.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
yum install php56w.x86_64 php56w-cli.x86_64 php56w-common.x86_64 php56w-gd.x86_64 php56w-ldap.x86_64 php56w-mbstring.x86_64 php56w-mcrypt.x86_64 php56w-mysql.x86_64 php56w-pdo.x86_64
```
> * 8安装sqlite3
```
yum install sqlite
```
> * 9.配置vhost虚拟主机
`关于ta有什么用，我现在也不是很清楚，但是没有ta是万万不行的哟`

**默认安装完上面的东西后，你会有以下目录：（没有的可以网上搜搜其他可能）**
```
// 网站根目录(切记是在html下面哟，和Windows的www下面不一样)
/var/www/html 
// Apache目录
/usr/sbin/apachectl
// Apache 配置文件目录 (常用的目录，要记得)
/etc/httpd/conf/httpd.conf
// php配置文件目录
/etc/php.ini
```
接下来在`/etc/httpd/conf/httpd.conf`里面添加一行
```
Include /etc/httpd/conf/vhost.conf
```
接下来编辑`vhost.conf`
**路径写自己的就对了，像`/var/www/html/test`绑定了网站根目录的test项目，其他的默认就行**
```
<VirtualHost *:80>
   <Directory /var/www/html/test>
        Options FollowSymLinks
        AllowOverride None
        Options None
        Order allow,deny
        Allow from all
   </Directory>
        DirectoryIndex index.php index.html
        ServerAdmin 2356979368@qq.com
        DocumentRoot /var/www/html/test
        ServerName liuhanyu.com
        ErrorDocument 404 /index.php
</VirtualHost>
```
> * 10.重启Apache服务器
```
/bin/systenctl start httpd.service // 启动
/bin/systenctl restart httpd.service // 重新启动
/bin/systenctl status httpd.service // 查看状态信息
```
> * 11.查看自己的ip地址
```
ip addr show // eth0 一般是这个 
ifconfig //
```
> * 12.windows下查看网站发布信息

**命令集合**
```
vi /etc/shadow //查看所有用户
// vi 模式下的查找
ESC进入命令模式，输入 /+查找内容  回车 n 查找下一个
// 列出所有php相关的包名
yum list installed | grep php
chmod 777 文件名  // 给予最高权限
```
  [1]: http://www.blogjava.net/nkjava/archive/2015/01/20/422289.html