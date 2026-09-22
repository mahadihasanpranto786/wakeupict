<?php

use App\model\Blog;
use App\model\BlogCategory;
use App\model\Expense;
use App\model\Income;
use App\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;


//blog count
function countBlogCategry($cat_name)
{
    $blog_cat = BlogCategory::where("category_name", $cat_name)
        ->first();
    $count_blog = Blog::where('category_id', $blog_cat->id)
        ->where('active_blog', 1)
        ->count();
    return $count_blog;
}
// helper for user authentication
function user($user_id)
{
    return  User::findOrFail($user_id)->excess_type;
}

//helper for human readable date
function dateformater($date)
{
    return Carbon::parse($date);
}

//user module excess for moderator
function checkUserType()
{
    $user = User::findOrFail(Auth::id())->type;
    if ($user == 'Moderator') {
        return 1;
    } else {
        return 0;
    }
}

// user roll
function userRolls()
{
    return $user_roll = App\model\UserRoll::where('user_id', Auth::id())
        ->where('is_deleted', 0)
        ->where('status', 1)
        ->get();
}

if (!function_exists('getGlobalExpenseLastMonth')) {
    function getGlobalExpenseLastMonth($category_id)
    {

        $now = Carbon::now()->subMonth();
        $globalExpenseLastMonth = Expense::where('title_id', $category_id)->where(["status" => 1, 'expense_type' => 'Global'])
            ->whereYear('date', '=', $now->format('Y'))
            ->whereMonth('date', '=', $now->format('m'))
            ->sum('amount');

        return $globalExpenseLastMonth;
    }
}


if (!function_exists('getGlobalIncomeLastMonth')) {
    function getGlobalIncomeLastMonth($category_id)
    {

        $now = Carbon::now()->subMonth();
        $globalIncomeLastMonth = Income::where('title_id', $category_id)->where(["status" => 1, 'income_type' => 'Global'])
            ->whereYear('date', '=', $now->format('Y'))
            ->whereMonth('date', '=', $now->format('m'))
            ->sum('amount');

        return $globalIncomeLastMonth;
    }
}

if (!function_exists('getLocalExpenseLastMonth')) {
    function getLocalExpenseLastMonth($category_id)
    {

        $now = Carbon::now()->subMonth();
        $localIncomeLastMonth = Expense::where('title_id', $category_id)->where(["status" => 1, 'income_type' => 'Local'])
            ->whereYear('date', '=', $now->format('Y'))
            ->whereMonth('date', '=', $now->format('m'))
            ->sum('amount');

        return $localIncomeLastMonth;
    }
}


if (!function_exists('getLocalIncomeLastMonth')) {
    function getLocalIncomeLastMonth($category_id)
    {

        $now = Carbon::now()->subMonth();
        $localIncomeLastMonth = Income::where('title_id', $category_id)->where(["status" => 1, 'income_type' => 'Local'])
            ->whereYear('date', '=', $now->format('Y'))
            ->whereMonth('date', '=', $now->format('m'))
            ->sum('amount');

        return $localIncomeLastMonth;
    }
}



if (!function_exists('uploadPlease')) {
    function uploadPlease($image)
    {

        $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->save('public/uploads/' . $imageName);
        return $img_url = 'public/uploads/' . $imageName;
        
    }
}

if (!function_exists('uploadPleaseWithSize')) {
    function uploadPleaseWithSize($image, $width, $height)
    {

        $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize($width, $height)->save('public/uploads/' . $imageName);
        return $img_url = 'public/uploads/' . $imageName;
        
    }
}