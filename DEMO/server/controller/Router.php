<?php
    class Router {
        // ·�ɱ�
        private $routers = array(
            array("name"=>"userlist", "pattern"=>"get /profile", "action"=>"Profile#get"),
            array("name"=>"userinfo", "pattern"=>"get /profile/:s", "action"=>"Profile#getById")/*,
            array("name"=>"useradd", "pattern"=>"post /user", "action"=>"User#add"),
            array("name"=>"userupdate", "pattern"=>"update /user", "action"=>"User#update"),
            array("name"=>"userdel", "pattern"=>"delete /user/:id", "action"=>"User#delete")*/
        );
        // ���
        public function dispatch() {
            $url = $_SERVER["REQUEST_URI"];
            $method = $_SERVER["REQUEST_METHOD"];
			
			//echo $method."<br/>";
			//echo $url."<br/><br/>";
			
            foreach ($this->routers as $router) {
                $pattern = $router["pattern"];
                $pats = explode(" ", $pattern);		//echo $pats[0]."==<br/>";
				
                if (strcasecmp($pats[0], $method) == 0) {
                    // �Ƿ��뵱ǰ·��ƥ��
					//echo  $router["pattern"]."<br/>";
                    $params = $this->checkUrl($method, strtolower($url), strtolower($pats[1]));
					
                    if ($params != null) {
                        array_shift($params);
                        $action = $router["action"];
						
                        // Ѱ�ҵ���һ��ƥ���·�ɼ�ִ�У�Ȼ�󷵻�
                        return $this->invoke($action, $params);
                    }
                }
            }
            echo "404";
            // error 404
        }
        private function invoke($action, $params) {
            $acts = explode("#", $action);
            $className = $acts[0];
            $methodName = $acts[1];
            $actionDir = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR."action";
            // ����action�ļ�
            $classFile = $actionDir.DIRECTORY_SEPARATOR.$className.".php";
			
			//echo $actionDir;
			//echo $classFile;
			
            if (! file_exists($classFile)) {
                // 404 error
                echo "404 error, no action found";
                return;
            } else {
                require "$classFile";
                // ʹ�÷���ִ�з���
                $rc = new ReflectionClass($className);
                if (! $rc->hasMethod($methodName)) {
                    // 404 error
                    echo "404 error, no method found";
                    return;
                } else {
                    $instance = $rc->newInstance();
                    $method = $rc->getMethod($methodName);
                    $method->invokeArgs($instance, $params);
                }
            }
        }
        // ����ƥ���飬����ȡ������
        private function checkUrl($method, $url, $pattern) {
            //echo "check url [ $url  ]with pattern [ $pattern ]<br/><br/><br/>";
            $ma = array();
            $pattern = ltrim(rtrim($pattern, "/"));
            $pattern = "/".str_replace("/", "\/", $pattern)."\/?$/";
            $pattern = str_replace(":s", "([^\/]+)", $pattern);
            //echo "pattern $pattern<br>";
            //$url = "/\".$url."$/";
            if (preg_match($pattern, $url, $ma) > 0) {
                return $ma;
            }
            return null;
        }
    }
	
?>