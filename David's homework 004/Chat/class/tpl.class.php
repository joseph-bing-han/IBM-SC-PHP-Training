<?php
    class template{

        //变量储存的数组
        private $vars = array();
        //模板目录
        public $template_dir = './template/';
        //缓存目录
        public $cache_dir = './cache/';
        //编译目录
        public $template_c_dir = './template_c/';
        //模板文件
        public $template_file = '';
        //左连接符
        public $left_delimiter = '<{';
        //右连接符
        public $right_delimiter = '}>';
        //编译文件
        private $template_c_file = '';
        //缓存文件
        private $cache_file = '';
        //缓存时间
        public $cache_time = 0;

        //内置解析器
        private $preg_temp = array(
            '~<\{(\$[a-z0-9_]+)\}>~i'
                => '<?php echo $1; ?>', // <{$name}>

            '~<\{(\$[a-z0-9_]+)\.([a-z0-9_]+)\}>~i'
                => '<?php echo $1[\'$2\']; ?>', // <{$arr.key}>

            '~<\{(\$[a-z0-9_]+)\.([a-z0-9_]+)\.([a-z0-9_]+)\}>~i'
                => '<?php echo $1[\'$2\'][\'$3\']; ?>', // <{$arr.key.key2}>

            '~<\?php\s+(include_once|require_once|include|require)\s*\s∗(.+?)\s∗\s*;?\s*\?>~i'
                => '<?php include \$this->_include($2); ?>', // ＜?php include('inc/top.php'); ?＞

            '~<\{:(.+?)\}>~' => '<?php echo $1; ?>', // <{:strip_tags($a)}>

            '~<\{\~(.+?)\}>~' => '<?php $1; ?>', // <{~var_dump($a)}>

            '~<\?=\s*~' => '<?php echo ', // <?=
        );

        /**
         *构造器
         */
        public function __construct(){
        	$__ROOT__ = $_SERVER["DOCUMENT_ROOT"].'/Chat/';
            if($__ROOT__){
                $this->template_c_dir = $__ROOT__ . 'template_c/';
                $this->cache_dir   = $__ROOT__ . 'cache/';
                $this->template_dir = $__ROOT__.'template/';
            }
        }

        /**
         *变量赋值
         *@param $key mixed 键名
         *@param $value mixed 值
         */
        public function assign($key , $value = ''){
            if(is_array($key)){
                $this->vars=array_merge($key,$this->vars);
            }
            else{
                $this->vars[$key]=$value;
            }
        }

        /**
         *显示页面
         *@param $file string 模板文件名
         */
        public function display($file){
            echo $this->fetch($file);
        }

        /**
         *返回缓存区内容
         *@param $file string 模板文件名
         *@return $content string 缓存内容
         */
        public function fetch($file){
            $this->template_file = $file;
            $desc_template_file = $this->template_dir .$file;
            $desc_content = $this->readfile($desc_template_file);

            $template_c_file_time= filemtime($desc_template_file);
            //若在超过缓存时间，则编译
            if($this->cache_time < time()-$template_c_file_time){
                $this->complie($this->token($desc_content));
            }
            //以下获取缓存区的内容
            ob_start();

            @extract($this->vars , EXTR_OVERWRITE);
            include ($this->template_c_dir . $this->template_c_file);

            $content = ob_get_contents();
            ob_end_clean();

            //$this->store_buff($content);
            return $content;
        }

        /*
         *替换分隔符，以及替换解析器的内容
         *@param $content string 读取的内容
         *@return $token_content string 替换后的内容
         */
        public function token($content){
            $token_content = $content;
            if(isset($left_delimiter) && $left_delimiter != '<{'){
                $token_content = str_replace($left_delimiter , '<{' , $token_content);
                $token_content = str_replace($right_delimiter, '}>' , $token_content);
            }
            $token_content = preg_replace(array_keys($this->preg_temp), $this->preg_temp , $token_content);
            return $token_content;
        }

        /*
         *生成储存
         *@param $content string 读取的内容
         *

        public function store_buff($content){
            $this->cache_file = md5($this->template_file) . $this->template_file . '.html';
            $tempfile = $this->cache_dir . $this->cache_file;
            $fp = fopen($tempfile , 'w');
            fputs($fp,$content);
            fclose($fp);
            unset($fp);
        }
        */

        /*
         *编译储存
         *@param $content string 读取的内容
         *
         */
        public function complie($content){
            $this->template_c_file = md5($this->template_file) . $this->template_file . '.php';
            $tempfile = $this->template_c_dir . $this->template_c_file;
            $fp = fopen($tempfile , 'w');
            fputs($fp,$content);
            fclose($fp);
            unset($fp);
        }

        /*
         *读取文件的内容
         *@param $file string 文件名
         *@return $content string 文件内容
         */
        public function readfile($file){
            if(file_exists($file)){
                $fp = fopen($file , 'r');
                $content ='';
                while(!feof($fp)){
                    $content .= fgets($fp,4096);
                }
                fclose($fp);
                unset($fp);
                return $content;
            }
            else{
                exit($file . ' not exist!');
            }
        }

        /*
         *模板嵌套
         *@param $file string 文件名
         *@return string 文件的绝对地址
         */
        public function _include($file){
            if(file_exists($this->template_dir . $file)){
                return ($this->template_dir . $file);
            }
            else{
                echo "模板文件不存在";
                exit;
            }
        }
    }
?>
