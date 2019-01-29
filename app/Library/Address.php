<?php


//IP地址查询接口类
class Address
{
	/**
	 * 请求接口返回内容
	 * @param  string $ip [查询的IP地址]
	 * @return  array 结果集
	 */
	public function getIp($ip)
	{
		//初始化curl
		$curl = curl_init();

		//接口地址
		$url = "http://apis.juhe.cn/ip/ip2addr?ip={$ip}&key=977727bd755b0817e1addf8863b535b8";

		//设置传输选项值
		curl_setopt($curl,CURLOPT_URL,$url);

		//把数据以文件流的形式返回
		curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);

		//执行curl并赋值给result
		$result = json_decode(curl_exec($curl),true);

		//关闭curl
		curl_close($curl);
		
		//查询出错
		if($result['resultcode'] != 200 ){

			return $result['result'] = ['area'=>'时区异常','locahost'=>'位置异常'];

		}else{

			return $result['result'];
		}

	}
}