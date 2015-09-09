<?php

/** 
 *日志函数
 * @author 李天中
 * 
 */
class LogUtil {
	
	/**
	 * 定义日志级别
	 * @var unknown_type
	 */
	const PLOG_FATAL = 1;
	const PLOG_WARNING = 2;
	const PLOG_NOTICE = 4;
	const PLOG_TRACE = 8;
	const PLOG_DEBUG = 16;
	
	public static $LOG_LEVEL_TO_NAME_LIST = array(
			self::PLOG_FATAL => 'FATAL',
			self::PLOG_WARNING => 'WARNING',
			self::PLOG_NOTICE => 'NOTICE',
			self::PLOG_TRACE => 'TRACE',
			self::PLOG_DEBUG => 'DEBUG',
	);
	
	private static $LOG_CACHE_LIST = array();
	private static $LOG_COUNT = 0;
	/**
	 * log id
	 * @var string
	 */
	private static $LOG_ID;
	/**
	 * log path
	 * @var string
	 */
	private static $LOG_PATH;
	/**
	 * log threshold
	 * @var int
	 */
	private static $LOG_THRESHOLD;
	
	/**
	 * 设置log id
	 * @param string $logId
	 */
	public static function setLogId($id){
		self::$LOG_ID = $id;
	}
	
	/**
	 * @return string $logId
	 */
	public static function getLogId(){
		if (empty(self::$LOG_ID)){
			self::$LOG_ID = floor(1000 * microtime(true)) . '_' . mt_rand(10000, 99999);
		}
		return self::$LOG_ID;
	}
	
	/**
	 * 设置log path
	 * @param string $logPath
	 */
	public static function setLogPath($logPath){
		self::$LOG_PATH = $logPath;
	}
	
	/**
	 * @return string $logId
	 */
	public static function getLogPath(){
		return self::$LOG_PATH;
	}
	
	/**
	 * 设置log threshold
	 * @param int $logThreshold
	 */
	public static function setLogThreshold($logThreshold){
		self::$LOG_THRESHOLD = $logThreshold;
	}
	
	/**
	 * @return int
	 */
	public static function getLogThreshold(){
		return self::$LOG_THRESHOLD;
	}
	/*
	*日志初始化
	*/
	public function start() {
		self::setLogPath(LOG_PATH);
		register_shutdown_function(array('LogUtil','flush'));
	}
	
	/*
	 * 停止时刷新
	 */
	public function stop() {
		self::flush();
	}
	
/**
     * 记录日志
     * @param string $logFileName
     * @param string $msg
     * @param string $where
     * @param int $level
     * 
     */
    public static function log($msg, $where = '', $level = self::PLOG_NOTICE){
        
        // format:  [TIME] [LEVEL] [LOGID] [WHERE] [MSG]
        $curTime = date('Y-m-d H:i:s');
        $line = '[' . $curTime . ']' . "\t";
        $line .= '[' . self::$LOG_LEVEL_TO_NAME_LIST[$level] . ']' . "\t";
        $line .= '[' . self::getLogId() . ']' . "\t";
        $line .= '[' . $where . ']' . "\t";
        $line .= '[' . $msg . ']' . "\t";
        $line .= "\n";
        
        if ($level === self::PLOG_FATAL){
            $logFileName = 'LOG.fatal.log';
        }else{
            $logFileName = 'LOG.log';
        }
        
        // write to cache
        if (!isset(self::$LOG_CACHE_LIST[$logFileName])){
            self::$LOG_CACHE_LIST[$logFileName] = array();
        }
        self::$LOG_CACHE_LIST[$logFileName][] = $line;
        self::$LOG_COUNT++;
        
        // real write
        if (self::$LOG_COUNT >= self::$LOG_THRESHOLD){
            self::flush();
        }
        
        return true;
    }
    
    /**
     * 保存到文件
     */
    public static function flush(){
        // 计算日志路径，按天分目录
        $curDate = date('Ymd');
        $logDir = self::$LOG_PATH . DIRECTORY_SEPARATOR . $curDate;
        if (!is_dir($logDir)){
            mkdir($logDir, 0775);
        }
        
        if (!empty(self::$LOG_CACHE_LIST)){
            foreach (self::$LOG_CACHE_LIST as $tmpFileName => $tmpLogList){
                if (empty($tmpLogList)){
                    continue;
                }
                // print log
                file_put_contents($logDir . DIRECTORY_SEPARATOR . $tmpFileName, implode('', $tmpLogList), FILE_APPEND);
            }
        }
        
        // unset(self::$LOG_CACHE_LIST);
        self::$LOG_CACHE_LIST = array();
        self::$LOG_COUNT = 0;
    }
}
?>