#&nbsp;&nbsp;如何同步一个Git远端仓库到本地

> * 创建一个Github账号
> * 登陆Github，查看远端仓库ssh地址复制下来
```
git@github.com:ab233/cd.git
```
> * 本地建一个和远端仓库同名的文件夹（cd）
> * 进入文件夹创建git环境
```
git bash here
git init
```
> * 配置用户名和邮箱 (注意别忘了 " " )
```
git config --global user.name "yourname"
git config --global user.email "your_email@youremail.com"
```
> * 配置本地到远端仓库的ssh秘钥
```
 ssh-keygen -t rsa -C "your_email@youremail.com"
```
> * 登陆Github -> seting ->新建ssh秘钥 -> 复制刚刚生成的秘钥到远端
> * 回到本地文件夹下：
```
git bash here
/* 刚刚复制的仓库ssh地址 */
git remote add origin git@github.com:ab233/cd.git 
/* 把远端仓库的信息拉到本地 */
git pull origin master /* 完成 */
```
### 平时的基本操作：
> * 修改文件后上传
```
git bash here
/* 查看本地仓库信息 */
git status
/* 添加要同步的文件信息 */
git add 被修改的文件（上面status可以看到详细信息）
/* 提交到本地版本库 */
git commit -m "本次修改说明"
git push origin master /* 推到远端仓库 */
```
