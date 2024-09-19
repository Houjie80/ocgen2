<?php
include('inc/config-inc.php');

function json_response($data) {
    $resp = array(
        'status' => 'OK',
        'data' => $data
    );
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = json_decode(file_get_contents('php://input'), true);
    if ($json !== null) {
        switch ($json['action']) {
	   case 'delete_ocgen':
                $output = null;
                $retval = null;
                exec('opkg remove luci-app-ocgen > /dev/null 2>&1; rm -rf /www/ocgen > /dev/null 2>&1 &', $output, $retval);
                if ($retval === 0) {
                    json_response('Ocgen has been deleted!');
                } else {
                    json_response('Failed to delete Ocgen');
                }
                break;
            case 'change_password':
                $password = $json['password'];
                $system_config = file_get_contents($ocgen_dir.'/system/config.json');
                $system_config = json_decode($system_config);
                if ($system_config !== null) {
                    $system_config->system->password = $password;
                    $system_config = json_encode($system_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                    if (file_put_contents($ocgen_dir.'/system/config.json', $system_config)) {
                        json_response("Password changed");
                    } else {
                        json_response("Failed to write file");
                    }
                } else {
                    json_response("Failed to decode system config file");
                }
                break;
            case 'restartRouter':
                $output = null;
                $retval = null;
                exec('reboot > /dev/null 2>&1 &', $output, $retval);
                if ($retval === 0) {
                    json_response('Router has been restarted!');
                } else {
                    json_response('Failed to restart router');
                }
                break;
            case 'restartOpenclash':
                $output = null;
                $retval = null;
                exec('/etc/init.d/openclash restart > /dev/null 2>&1 &', $output, $retval);
                if ($retval === 0) {
                    json_response('Openclash has been restarted!');
                } else {
                    json_response('Failed to restart Openclash');
                }
                break;
            case 'check_clash_status':
                $status = shell_exec("pgrep -f openclash_watch");
                $clashStatus = $status ? true : false;
                $response = array('clash' => $clashStatus);
                json_response($response);
                break;
            case 'check_uptime_status':
                // Menyimpan output perintah cpustat -u
				$output = shell_exec('cpustat -u');

				// Memecah output menjadi array berdasarkan spasi
				$uptimeArray = explode(' ', $output);

				// Mendapatkan nilai dari array
				$days = 0;
				$hours = 0;
				$minutes = 0;
				$seconds = 0;

				foreach ($uptimeArray as $uptimeValue) {
				if (strpos($uptimeValue, 'd') !== false) {
						$days = intval($uptimeValue);
					} elseif (strpos($uptimeValue, 'h') !== false) {
						$hours = intval($uptimeValue);
					} elseif (strpos($uptimeValue, 'm') !== false) {
						$minutes = intval($uptimeValue);
					} elseif (strpos($uptimeValue, 's') !== false) {
						$seconds = intval($uptimeValue);
						}
					}
				// Format waktu
				$uptime = $days . "d:" . $hours . "h:" . $minutes . "m:" . $seconds . "s";
				$respon_uptime = array('uptime' => $uptime);
                json_response($respon_uptime);
                break;
            default:
                json_response("Invalid action");
                break;
            case 'change_theme':
                $theme = $json['theme'];
                $system_config = file_get_contents($ocgen_dir.'/system/config.json');
                $system_config = json_decode($system_config);
                if ($system_config !== null) {
                    $system_config->system->theme = $theme;
                    $system_config = json_encode($system_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
                    if (file_put_contents($ocgen_dir.'/system/config.json', $system_config)) {
                        json_response("Theme changed");
                    } else {
                        json_response("Failed to write file");
                    }
                } else {
                    json_response("Failed to decode system config file");
                }
                break;
        }
    } else {
        json_response("Invalid JSON data");
    }
}
?>
