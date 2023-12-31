<?php

if (!function_exists('preout')) {
    function preout($v)
    {
        echo "<pre>";
        var_dump($v);
        echo "</pre>";
    }
}

if (!function_exists('preson')) {
    function preson($v)
    {
        echo "<pre>";
        echo json_encode($v,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        echo "</pre>";
    }
}

if (!function_exists('presonRet')) {
    function presonRet($v)
    {
        return json_encode($v,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}

if (!function_exists('lq')) {
    function lq($ctx)
    {
        echo $ctx->db->last_query();
    }
}

if (!function_exists('logs')) {
    // logs(glq($this))
    function logs($v="") {
        // glq($this)
        $ctx = &get_instance();
        $ctx->load->model('LoggerModel', "mlogger");
        
        return $ctx->mlogger->logs("general", $v);
    }
}

if (!function_exists('noHtml')) {
    function noHtml($data = ""){
        return preg_replace('/<(\w+)\b(?:\s+[\w\-.:]+(?:\s*=\s*(?:"[^"]*"|"[^"]*"|[\w\-.:]+))?)*\s*\/?>\s*<\/\1\s*>/', "", $data);
    }
}

if (!function_exists('jsonResponse')) {
    function jsonResponse($respCode,$msg,$data, $fmt=true)
    {
        if($fmt){
            $r = [
                'status' => $respCode ,
                'message' => $msg ,
                'data' => $data
            ];
        }else{
            $r = $data;
        }

        $CI = &get_instance();
        $CI->output
            ->set_status_header($respCode)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($r));
    }
}

if (!function_exists('toFile')) {
    function toFile($content = "cnt", $file = "file")
    {
        $f = fopen($file, "w");
        fwrite($f,$content);
        fclose($f);
        return true;
    }
}

if (!function_exists('arrayGet')) {
    function arrayGet($array, $key, $default = NULL)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}

if (!function_exists('arrget')) {
    function arrget($array, $key, $default = NULL)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}

if (!function_exists('sbadmin')) {
    function sbadmin($file)
    {
        return base_url($file);
    }
}

class KejaksaanEnt{
	static function padKodeInstansi($kode){
		if($kode != 'all'){
            $mainPad = "00.00.00";
            $mpLen = strlen($mainPad);
            $kLen = strlen($kode);

            if($kLen > 0 && $kLen <= 8){
                return str_pad($kode, 8, 
                    substr($mainPad, strlen($kode), $mpLen-strlen($kode))
                );
            }
            
            return $mainPad;
        } else {
            return 'all';
        }
	}

	// c = 3 dot full padded kode instansi
	static function parseInsCode($c){
		$arr = explode(".", $c);

		if(sizeof($arr) != 3){
			throw new \Exception("Len of exploded arr !=3 : " . presonRet($arr));
		}

		return [
			"kt" => $arr[0],
			"kn" => $arr[1],
			"ckn" => $arr[2],
		];
	}
}