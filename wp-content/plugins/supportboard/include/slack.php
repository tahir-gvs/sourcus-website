<?php
/**
 * ======================================
 * SLACK - DIRECT MESSAGE SYSTEM
 * ======================================
 *
 * This file receive the messages sent from Slack and process them for save it into the database and for show them to the user's chat or desk
 *
 * ONLY TEXT - RESPONSE EXAMPLE
 * $json = '{"token":"GUwjUFxF9V8tvtKKG4C5IKzJ","team_id":"T6QHRMS9G","api_app_id":"A6GR47Q9K","event":{"type":"message","user":"U6QHRMSHY","text":"merdina","ts":"1503387726.000202","channel":"C6RK0B3A5","event_ts":"1503387726.000202"},"type":"event_callback","authed_users":["U6QHRMSHY"],"event_id":"Ev6R8UHBQ9","event_time":1503387726}';
 *
 * TEXT AND ATTACHMENTS - RESPONSE EXAMPLE
 * $json = '{ "token": "GUwjUFxF9V8tvtKKG4C5IKzJ", "team_id": "T92UG81GD", "api_app_id": "A6GR47Q9K", "event": { "type": "message", "text": "fgferrattftgdgdf", "files": [{ "id": "FJ804C01F", "created": 1556963414, "timestamp": 1556963414, "name": "documentation.pdf", "title": "documentation.pdf", "mimetype": "application\/pdf", "filetype": "pdf", "pretty_type": "PDF", "user": "U928T708Z", "editable": false, "size": 449427, "mode": "hosted", "is_external": false, "external_type": "", "is_public": true, "public_url_shared": false, "display_as_bot": false, "username": "", "url_private": "https:\/\/files.slack.com\/files-pri\/T92UG81GD-FJ804C01F\/documentation.pdf", "url_private_download": "https:\/\/files.slack.com\/files-pri\/T92UG81GD-FJ804C01F\/download\/documentation.pdf", "thumb_pdf": "https:\/\/files.slack.com\/files-tmb\/T92UG81GD-FJ804C01F-c3f4ddf271\/documentation_thumb_pdf.png", "thumb_pdf_w": 910, "thumb_pdf_h": 1286, "permalink": "https:\/\/skiokko.slack.com\/files\/U928T708Z\/FJ804C01F\/documentation.pdf", "permalink_public": "https:\/\/slack-files.com\/T92UG81GD-FJ804C01F-77753c2069", "has_rich_preview": false }], "upload": true, "user": "U928T708Z", "display_as_bot": false, "ts": "1556963415.001600", "client_msg_id": "585e99a8-bc08-4660-9a9d-3fd7aca24332", "channel": "CJE8V9NA1", "subtype": "file_share", "event_ts": "1556963415.001600", "channel_type": "channel" }, "type": "event_callback", "event_id": "EvJ804C91P", "event_time": 1556963415, "authed_users": ["U928T708Z"] }';
 */

global $sb_config;
$is_php = true;
require_once("../include/functions.php");
if (!file_exists("../../../../wp-load.php")) {
    require_once("../php/functions.php");
} else {
    $is_php = false;
    if (!isset($sb_config)) {
        $sb_config = json_decode(str_replace('\\"','"', sb_get_option("sb-settings")), true);
    }
    if (sb_get($sb_config, "users-engine") == "wp") {
        require_once("../../../../wp-load.php");
    }
}

header('Content-Type: application/json');
ob_start();
$json = file_get_contents('php://input');
$arr_slack = json_decode($json, true);
ob_end_clean();

$result = "error arr_slack";
$subtype;
if (isset($arr_slack["event"]["subtype"])) {
    $subtype = $arr_slack["event"]["subtype"];
}
if (isset($arr_slack["event"]["type"]) && $arr_slack["event"]["type"] == "message" && (!isset($subtype) || $subtype == "file_share") && ($arr_slack["event"]["text"] != "" || (is_array($arr_slack["event"]["files"]) && count($arr_slack["event"]["files"]) > 0))) {
    $sb_slack_channels_arr = json_decode(sb_get_option("sb-slack-channels"), true);
    $result = "error sb_slack_channels_arr";
    if (isset($sb_slack_channels_arr)) {
        $channel_id = $arr_slack["event"]["channel"];
        $user_id;
        foreach ($sb_slack_channels_arr as $key => $value) {
            if ($value["channel_id"] == $channel_id) {
                $user_id = $key;
                break;
            }
        }
        $result = "error user_id";
        if (isset($user_id)) {
            $msg = $arr_slack["event"]["text"];
            $file_string = "";
            $file_email = array();
            if ($subtype == "file_share") {
                $files_arr = $arr_slack["event"]["files"];
                if (!isset($sb_config)) {
                    $sb_config = json_decode(str_replace('\\"','"', sb_get_option("sb-settings")), true);
                }
                for ($i = 0; $i < count($files_arr); $i++) {
                    $raw = sb_run_curl("https://slack.com/api/files.sharedPublicURL", array("token" => $sb_config["slack-token"], "file" => $files_arr[$i]["id"]));
                    $arr = json_decode($raw, true);
                    $link = "";
                    if (isset($arr["file"])) {
                        $link = $arr["file"]["permalink_public"];
                    }
                    $file_string .= $link . "|" . str_replace("?", "", $files_arr[$i]["title"]) . "?";
                }
                if ($file_string != "") {
                    $file_string = mb_substr($file_string,0, strlen($file_string) - 1);
                }
                array_push($file_email, $link);
            }

            $agent = sb_get_agent($arr_slack["event"]["user"], "slack");
            sb_add_message($user_id, $msg, "unix" . time(), $agent["id"], $agent['img'], $agent['username'], $file_string);
            $result = "success";

            //Notifications
            $sendAllowed = sb_check_email_allowed($user_id);
            if ($sendAllowed) {
                if (!isset($sb_config)) {
                    $sb_config = json_decode(str_replace('\\"','"', sb_get_option("sb-settings")), true);
                }
                $user = sb_get_user($user_id);
                if (isset($sb_config["notify-user-email"]) && isset($user["email"])) {
                    if ($user["email"] != "") {
                        $emails = sb_get_emails($agent['username'], $msg, $file_email, false, "user", ($is_php ? "php":"wp"));
                        sb_send_email($user["email"], $emails[0], $emails[1]);
                    }
                }
            }
        }
    }
}

//$file = fopen("debug.txt","w");
//fwrite($file, $json)  or die("Unable to open file!");
?>