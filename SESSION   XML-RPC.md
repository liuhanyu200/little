# SESSION   XML-RPC

标签：PHP  

---

> * XML-RPC（remote produce call）在[维基百科][1]里面是这么定义的：一个远程过程调用的分布式计算协议，通过XML函数进行封装，并使用HTTP协议作为传送机制。

---
###小例子(CI框架下的demo)：
`客户端`：
```php
<?php

class Xmlrpc_client extends CI_Controller {

    public function index()
    {
        // 加载helper下的url类
        $this->load->helper('url');
        // 设置请求的url
        $server_url = site_url('xmlrpc_server');
        // 加载xmlrpc类
        $this->load->library('xmlrpc');
        // 设置服务器IP地址和端口号
        $this->xmlrpc->server($server_url, 80);
        // 设置请求方法
        $this->xmlrpc->method('Greetings');
        // 设置请求参数
        $request = array('How is it going?');
        // 发送请求    
        $this->xmlrpc->request($request);
        // fail
        if ( ! $this->xmlrpc->send_request())
        {
            echo $this->xmlrpc->display_error();
        }
        else // success
        {
            echo '<pre>';
            print_r($this->xmlrpc->display_response());
            echo '</pre>';
        }
    }
}
?>
```
`服务端`：
```php
<?php

class Xmlrpc_server extends CI_Controller {

    public function index()
    {   
        // 加载类库
        $this->load->library('xmlrpc');
        $this->load->library('xmlrpcs');
        // 设置请求方法和要调用的类
        $config['functions']['Greetings'] = array('function' => 'Xmlrpc_server.process');
        // 初始化
        $this->xmlrpcs->initialize($config);
        $this->xmlrpcs->serve();
    }


    public function process($request)
    {
        // 接收请求内容
        $parameters = $request->output_parameters();
        // 设置返回内容
        $response = array(
            array(
                'you_said'  => $parameters[0],
                'i_respond' => 'Not bad at all.'
            ),
            'struct'
        );
        // 返回
        return $this->xmlrpc->send_response($response);
    }
}
```

> * HTTP session（[会话][2]）。HTTP是无状态的，不保存请求数据的协议，所以，在构建复杂应用的时候，session就诞生了。session是用来存储数据，弥补HTTP的不足。

```
session_id();
```


  [1]: https://zh.wikipedia.org/wiki/XML-RPC
  [2]: https://zh.wikipedia.org/wiki/%E4%BC%9A%E8%AF%9D_%28%E8%AE%A1%E7%AE%97%E6%9C%BA%E7%A7%91%E5%AD%A6%29