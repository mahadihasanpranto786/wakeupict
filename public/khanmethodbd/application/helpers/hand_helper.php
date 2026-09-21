<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function numberToWorld($number)
{
    $search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $replace_array = array("One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Zero");
    $wordN = str_replace($search_array, $replace_array, $number);

    return $wordN;
}



function alert_check()
{
    $mx = &get_instance();

    if ($success = $mx->session->flashdata('success')) {
?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4> <?= $success; ?></h4>
        </div>
    <?php } ?>

    <?php
    if ($error = $mx->session->flashdata('error')) {
    ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Error!</strong> <?= $error; ?>
        </div>
    <?php }
}

function pegination_genarate($links)
{
    ?>
    <div style="padding: 60px;">
        <nav aria-label="Page navigation">
            <div class="pagination">
                <ul class="pagination">
                    <?php foreach ($links as $link) {
                        echo "<li>" . $link . "</li>";
                    } ?>
            </div>
        </nav>
    </div>


<?php

}

function set_confirmation_msg($data, $true_msg, $false_msg)
{
    $confirm = 0;
    $xcaliver = &get_instance();
    if ($data == FALSE) {
        $xcaliver->session->set_flashdata('error', $false_msg);
    } else {
        $xcaliver->session->set_flashdata('success', $true_msg);
        $confirm = 1;
    }
    return $confirm;
}

function get_current_time()
{

    $date = new DateTime('now', new DateTimezone('Asia/Dhaka'));
    $current_time = $date->format('Y-m-d H:i') . "\n";
    return $current_time;
}
function timeformater($getTime)
{
    return date("Y-m-d", strtotime($getTime));
}


//get data general settings
function get_data_single_muli_con($table, $data)
{
    $mx = &get_instance();
    $mx->db->where($data);
    $query = $mx->db->get($table)->row();
    return $query;
}

function get_rltn_data($table, $index, $data)
{
    $mx = &get_instance();
    //$mx->db->where($index, $data);
    $query = $mx->Common->get_data_single($table, $index, $data);
    return $query;
}

function get_rltn_data_multi_con($table, $data)
{
    $mx = &get_instance();
    //$mx->db->where($index, $data);
    $query = $mx->Common->get_data_multi_conditional($table, $data);
    return $query;
}

function category($table)
{
    $mx = &get_instance();
    //$mx->db->where($index, $data);
    $query = $mx->Common->category($table);
    return $query;
}

function get_data_muli_con_order_limit($table, $data, $order, $limit)
{
    $mx = &get_instance();
    //$mx->db->where($index, $data);
    $query = $mx->Frontend->get_data_muli_con_order_limit($table, $data, $order, $limit);
    return $query;
}

function shorten_string($string, $wordsreturned)
{
    $retval = $string;
    $array = explode(" ", $string);
    if (count($array) <= $wordsreturned) {
        $retval = $string;
    } else {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array) . " ";
    }
    return $retval;
}

function active_nav($nav, $check_nav)
{

    if ($nav == $check_nav) {
        return "active";
    }
}

function bn_date($str)
{
    $en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
    $bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
    $str = str_replace($en, $bn, $str);
    $en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
    $bn = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
    $str = str_replace($en, $bn, $str);
    $str = str_replace($en_short, $bn, $str);
    $en = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
    $en_short = array('Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');
    $bn_short = array('শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ', 'শুক্র');
    $bn = array('শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
    $str = str_replace($en, $bn, $str);
    $str = str_replace($en_short, $bn_short, $str);
    $en = array('am', 'pm');
    $bn = array('পূর্বাহ্ন', 'অপরাহ্ন');
    $str = str_replace($en, $bn, $str);
    return $str;
}

function date_tine_formater($get_date)
{
    $dt = new DateTime($get_date, new DateTimezone('Asia/Dhaka'));
    return $dt->format('l, d M Y, h:i a');
}

//---------------------------------------//

function identify_color($type, $card)
{
    $casino = &get_instance();
    $query = array(
        'board_type' => $type,
        'board_status' => 0
    );
    $board_data = $casino->Boardend->get_board_data("board", $query);
    if ($board_data == FALSE) {
        return "try";
    } else {
        $board_id = $board_data->board_id;
        $query = array(
            'class_name' => $card,
            'board_id' => $board_id
        );
        $card_check = $casino->Common->get_data_multi_conditional("board_details", $query);
        if ($card_check == FALSE) {
            return "try";
        } else {
            return "not_open";
        }
    }



    // $mx->db->where($index, $data);
    // $query = $mx->db->get($table);
    // if ($query) {
    //     if (0 < $query->num_rows())
    //         return "checked";
    // }
}

function x_debug($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit();
}

function set_pagination($total_row, $url, $per_page_data)
{
    $config['base_url'] = base_url($url);
    $config['reuse_query_string'] = TRUE;
    $config['total_rows'] = $total_row;
    $config['per_page'] = $per_page_data;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination_ci_custom text-dark d-inline">';
    $config["full_tag_close"] = '</ul>';
    $config["first_link"] = False;
    $config["first_tag_open"] = '<li>';
    $config["first_tag_close"] = '</li>';
    $config["last_link"] = False;
    $config["num_links"] = 3;
    $config['next_link'] = '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>';
    $config["next_tag_open"] = '<li>';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';
    $config["prev_tag_open"] = "<li>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = "<li class='text-white'><a class='active text-white'style='background-color:#5f3afc' href='#'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li>";
    $config["num_tag_close"] = "</li>";
    get_instance()->pagination->initialize($config);
}

function pagination_offset($val, $par_page_data)
{
    $offset = 0;
    if (get_instance()->uri->segment($val)) {
        $offset = (get_instance()->uri->segment($val) - 1) *  $par_page_data;
    }
    return $offset;
}
function serial_number_par_page($segment, $par_page_data)
{
    $page_no = get_instance()->uri->segment($segment);
    if ($page_no) {
        return (($page_no - 1) * $par_page_data) + 1;
    } else {
        return 1;
    }
}

function active_open($nav, $check_nav)
{
    if ($nav == $check_nav) {
        return "menu-open";
    }
}

function resultCheck($row, $resultID, $indexName, $table)
{
    $dbDiver = &get_instance();
    $resultData =  $dbDiver->db->where("$resultID", $row)->get($table);
    if (!empty($resultData->result())) {
        if ($row == $resultData->result()[0]->$resultID) {
            return $resultData->result()[0]->$indexName;
        }
    } else {

        return (object)array($indexName => 0);
    }
}
function winner($i)
{
    if ($i <= 10) {
        return "f_o";
    } elseif ($i <= 20) {
        return "s_o";
    } elseif ($i <= 30) {
        return "t_o";
    } elseif ($i <= 36) {
        return "ff_o";
    } else {
        return "l_o";
    }
}
