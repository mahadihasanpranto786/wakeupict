<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function numberToWorld($number)
{
	$search_array = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
	$replace_array = array("One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Zero");
	$wordN = str_replace($search_array, $replace_array, $number);

	return $wordN;
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

function set_confirmation_msg($data, $true_msg, $false_msg)
{
	$driverInstanse = &get_instance();
	$confirm = 0;
	if ($data == FALSE) {
		$driverInstanse->session->set_flashdata('error', $false_msg);
	} else {
		$driverInstanse->session->set_flashdata('success', $true_msg);
		$confirm = 1;
	}
	return $confirm;
}






function x_debug($data)
{
	echo '<pre>';
	print_r($data);
	echo "<br>";
	exit();
}

function x_call()
{
	$driverInstanse = &get_instance();
	echo '<pre>';
	print_r($driverInstanse->input->post());
	echo "<br>";
	exit();
}

function initialZero($value)
{
	if (!$value) {
		return 0;
	}
	return $value;
}


function talkTomoney($number)
{
	$n = (int)($number);
	$koti = "কোটি ";
	$lokkho = 'লাখ ';
	$hajar = 'হাজার ';
	$soto = 'শত ';
	$koti_cutter = 10000000;
	$lokkho_cutter = 100000;
	$hajar_cutter = 1000;
	$soto_cutter = 100;

	// echo $number;
	// echo '<br>';

	$k = (int)($number / $koti_cutter);
	$number =  (fmod($number, $koti_cutter));
	$l = (int)($number / $lokkho_cutter);
	$number =  (fmod($number, $lokkho_cutter));
	$h = (int)($number / $hajar_cutter);
	$number =  (fmod($number, $hajar_cutter));
	$s = (int)($number / $soto_cutter);
	$number =  (fmod($number, $soto_cutter));
	$string = '';
	if (!$k == 0) {
		$string .= $k . ' ' . $koti;
	}
	if (!$l == 0) {
		$string .= ' ' . $l . ' ' . $lokkho;
	}
	if (!$h == 0) {
		$string .= $h . ' ' . $hajar;
	}
	if (!$s == 0) {
		$string .= $s . ' ' . $soto;
	}
	if (!$number == 0) {
		$string .= ' ' . $number;
	}
	$string .= ' টাকা';
	echo $string;
}



function number_currency_format($num, $point)
{
	if ($num) {
		$formatNumber = number_format($num, $point, '.', ',');
		return $formatNumber;
	} else {
		return 0;
	}
}



// Get Dynamic Month Name
function get_all_month()
{
	$months = array(
		'01' => 'January',
		'02' => 'February',
		'03' => 'March',
		'04' => 'April',
		'05' => 'May',
		'06' => 'June',
		'07' => 'July ',
		'08' => 'August',
		'09' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December',
	);
	return $months;
}


function get_all_year()
{
	$driverInstanse = &get_instance();
	$openingDateOfFy = $driverInstanse->M_financial_year->getFirstFinancialYear()->fy_start_date;
	$firstYear = date("Y", strtotime($openingDateOfFy));
	$now = new DateTime();
	$year = $now->format("Y");
	$allYear = [];
	for ($i = $firstYear; $i <= $year; $i++) {
		array_push($allYear, $i);
	}
	$reverse = array_reverse($allYear, true);
	return $reverse;
}




/*
|--------------------------------------------------------------------------
| Pagination
|--------------------------------------------------------------------------
*/
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

function pagination_offset($val, $per_page_data)
{
	$offset = 0;
	if (get_instance()->uri->segment($val)) {
		$offset = (get_instance()->uri->segment($val) - 1) *  $per_page_data;
	}
	return $offset;
}

function serial_number_per_page($segment, $per_page_data)
{
	$page_no = get_instance()->uri->segment($segment);
	if ($page_no) {
		return (($page_no - 1) * $per_page_data) + 1;
	} else {
		return 1;
	}
}

// Pagination search action
function paginationSearch($url, $search, $method, $placeholderText)
{
?>
	<div class="row">
		<div class="col-sm-8 p-0"></div>
		<div class="col-sm-4 text-right p-0">
			<table class="table table-borderless">
				<tr>
					<td class="d-flex justify-content-end text-right">
						<form action="<?php echo base_url($url); ?>" method="<?php echo $method; ?>" class="inline-block" style="width:90%;">
							<div class="input-group mb-3">
								<input type="search" name="search" value="<?= $search ? $search : false ?>" class="form-control" placeholder="<?php echo $placeholderText; ?>" aria-label="Search">
								<div class="input-group-append">
									<button type="submit" class="btn-primary border-0">Submit</button>
								</div>
							</div>
						</form>
						<form action="<?php echo base_url($url); ?>" method="<?php echo $method; ?>" style="width:10%;">
							<div class="input-group mb-3">
								<div class="input-group-append">
									<button type="submit" class="btn-danger border-0" style="height: 38px; width:100%;">Reset</button>
								</div>
							</div>
						</form>
					</td>
				</tr>
			</table>
		</div>
	</div>
<?php }

function showingResultCountPagination($array_data_list, $total_rows)
{
?>
	<div class="row py-3 mt-2 align-middle">
		<div class="col-sm-4">
			<input type="hidden" id="valRes" value="<?php if (isset($array_data_list->result_id->num_rows)) {
														echo $array_data_list->result_id->num_rows;
													} else {
														echo 0;
													} ?>">
			<span>Showing <span id="showingRow"></span> Result From <?= $total_rows ?>
				Result</span>
		</div>
		<div class="col-sm-8 text-right">
			<div class="basic-pagination pull-right wow fadeInUp new__custom__pagination" data-wow-delay=".2s">
				<?= get_instance()->pagination->create_links() ?><br>
			</div>
		</div>
	</div>
<?php }

//User Type
function userType()
{
	$users = array(
		'101' => 'Security Department Head',
		'102' => 'Security Department Operator',
		'201' => 'Weight Department Head',
		'202' => 'Weight Department Operator',
		'301' => 'ute Department Head',
		'302' => 'Jute Department Operator',
		'401' => 'Accounts Department Head',
		'402' => 'Accounts Department Operator',
		'501' => 'Production Department Head',
		'502' => 'Production Department Operator',
		'601' => 'Authority General Manager',
		'602' => 'Authority Shareholder',
		'603' => 'Authority System Administrator',
		'701' => 'Store Department Head',
		'702' => 'Store Department Operator',
	);
	return $users;
}
