const fs = require('fs');
let content = fs.readFileSync('resources/views/frontend/theme/clasic/frontend_layouts/home_page.blade.php', 'utf8');

// 1. Course button
content = content.replace(
    /<a href="\{\{ route\('course-details', \$course->course_slug \?: \$course->id\) \}\}" class="w-full py-2\.5 px-4 rounded-xl btn-brand-primary text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2 group-hover:shadow-lg">[\s\S]*?<span>বিস্তারিত ও সিলেবাস<\/span>[\s\S]*?<i class="fa fa-arrow-right text-\[10px\] transition-transform group-hover:translate-x-1"><\/i>[\s\S]*?<\/a>/,
    `<a href="{{ route('course-details', $course->course_slug ?: $course->id) }}" class="w-full py-2.5 px-4 rounded-xl btn-brand-primary text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2 group-hover:shadow-lg" style="background-color: #F26522 !important; color: #FFFFFF !important;">
                                        <span style="color: #FFFFFF !important;">বিস্তারিত ও সিলেবাস</span>
                                        <i class="fa fa-arrow-right text-[10px] transition-transform group-hover:translate-x-1" style="color: #FFFFFF !important;"></i>
                                    </a>`
);

// 2. Student dashboard / login buttons on home page
content = content.replace(
    /<a href="\{\{ route\('student\.dashboard'\) \}\}" class="px-6 py-3\.5 rounded-xl btn-brand-primary text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">[\s\S]*?<i class="fa fa-tachometer"><\/i>[\s\S]*?<span>ড্যাশবোর্ডে প্রবেশ করুন<\/span>[\s\S]*?<\/a>/,
    `<a href="{{ route('student.dashboard') }}" class="px-6 py-3.5 rounded-xl btn-brand-primary text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2" style="background-color: #F26522 !important; color: #FFFFFF !important;">
                                    <i class="fa fa-tachometer" style="color: #FFFFFF !important;"></i>
                                    <span style="color: #FFFFFF !important;">ড্যাশবোর্ডে প্রবেশ করুন</span>
                                </a>`
);

content = content.replace(
    /<a href="\{\{ route\('student\.login'\) \}\}" class="px-6 py-3\.5 rounded-xl btn-brand-primary text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">[\s\S]*?<i class="fa fa-sign-in"><\/i>[\s\S]*?<span>স্টুডেন্ট লগইন<\/span>[\s\S]*?<\/a>/,
    `<a href="{{ route('student.login') }}" class="px-6 py-3.5 rounded-xl btn-brand-primary text-white font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2" style="background-color: #F26522 !important; color: #FFFFFF !important;">
                                    <i class="fa fa-sign-in" style="color: #FFFFFF !important;"></i>
                                    <span style="color: #FFFFFF !important;">স্টুডেন্ট লগইন</span>
                                </a>`
);

fs.writeFileSync('resources/views/frontend/theme/clasic/frontend_layouts/home_page.blade.php', content, 'utf8');
console.log('home_page.blade.php updated successfully');

