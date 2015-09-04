<?php

class Dir extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $query = $this->db->query("SELECT * FROM `tbl_user`");
        print_r($query->num_rows());
    }
    
    public function edit_httpd() {
        $path = 'C:/xampp/apache/conf/httpd.conf';
        $file = fopen($path, 'a');
        $str = "\n<VirtualHost *:80>\n";
        $str .= "DocumentRoot C:/xampp/htdocs/shop/Working/users/113-stxxxxxes\n";
        $str .= "ServerName tenwebsite.phumaster.dev\n";
        $str .= "</VirtualHost>\n";
        if(fwrite($file, $str)){
            return TRUE;
        }else{
            return FALSE;
        }
        fclose($file);
    }

    private function del_dir($str) {
        $director = scandir($str);
        foreach ($director as $file) {
            if (is_dir($str . $file)) {
                echo array_diff('.', '..');
            } else {
                echo $str . $file . '<br/>';
            }
        }
    }

    public static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function getLink() {
        $this->load->view('tt');
        for ($i = 3570; $i < 3572; $i++) {
            $data = file_get_contents('https://vozforums.com/showthread.php?t=2065093&page=' . $i);
            $str = preg_match_all('/(<img[^>]*(.*)[^>])/i', $data, $matches);
            foreach ($matches as $key => $vals) {
                $arr = implode(" ", $vals);
                $arr = str_replace('<br />', '', $arr);
                $arr = str_replace('</td>', '', $arr);
                $arr = str_replace('</font>', '', $arr);
                $arr = str_replace('</iframe>', '', $arr);
                $arr = str_replace('<img src="images/buttons/reply.gif" alt="Reply" border="0" /></a>', '', $arr);
                $arr = str_replace('<img src="/clear.gif" border="0" alt="vozForums" width="184" height="90" /></a></div>', '', $arr);
                $arr = str_replace('<img src="images/misc/navbits_start.gif" alt="Go Back" border="0" />', '', $arr);
                $arr = str_replace('<img src="images/buttons/quote.gif" alt="Reply With Quote" border="0" />', '', $arr);
                $arr = str_replace('<img src="/clear.gif" alt="vozForums" height="90" border="0" width="184">', '', $arr);
                $arr = str_replace('<img src="http://vozforums.com/specials/zotac_alt1Active_bg.png" style="vertical-align: middle; margin-left: 20px">', '', $arr);
                $arr = str_replace('<img src="http://vozforums.com/specials/tenten_alt1Active_bg.png" style="vertical-align: middle; margin-left: 20px">', '', $arr);
                $arr = str_replace('<img src="http://vozforums.com/specials/thermaltake_alt1Active_bg2.png" style="vertical-align: middle; margin-left: 12px">', '', $arr);
                $arr = str_replace('<img src="http://vozforums.com/specials/maihoang_alt1Active_bg.jpg" style="vertical-align: middle; margin-left: 12px">', '', $arr);
                $arr = str_replace('<img src="http://vozforums.com/specials/didongnet_alt1Active_bg.png" style="vertical-align: middle; margin-left: 20px">', '', $arr);
                $arr = str_replace('<img src="http://vozforums.com/specials/coolermaster_alt1Active_bg.png" style="vertical-align: middle; margin-left: 10px">', '', $arr);
                echo $arr;
            }
        }
    }

    public function this() {
        echo '<pre>';
        $file = "C:/xampp/apache/conf/httpd.conf";
        $content = fopen($file, 'a+');
        while (!feof($content)) {
            echo fgets($content);
        }
        fclose($content);
    }

    public function dk() {
        //$this->load->view('dk');
    }

}
