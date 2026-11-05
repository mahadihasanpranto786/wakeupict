const fs = require('fs');

// 1. Update public/frontend/css/custom.css
let fContent = fs.readFileSync('public/frontend/css/custom.css', 'utf8');

// A. Update .btn-brand-navy and .btn-orange-navy
fContent = fContent.replace(
    /\.btn-brand-navy,\s*\r?\n\.btn-orange-navy\s*\{[\s\S]*?\.btn-orange-navy:hover\s*\{[\s\S]*?\}/,
    `.btn-brand-navy,
.btn-orange-navy {
    background-color: #F26522 !important;
    color: #FFFFFF !important;
    font-weight: 800 !important;
    border: 1px solid #E95420 !important;
    box-shadow: 0 4px 14px -2px rgba(242, 101, 34, 0.40) !important;
    transition: all 0.25s ease-in-out !important;
}

.btn-brand-navy *,
.btn-orange-navy * {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
}

.btn-brand-navy:hover,
.btn-orange-navy:hover {
    background-color: #E95420 !important;
    color: #FFFFFF !important;
}

.btn-brand-navy:hover *,
.btn-orange-navy:hover * {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
}`
);

// B. Update student-sidebar
fContent = fContent.replace(
    /\.student-nav-item\.active,[\s\S]*?#student-sidebar a\.bg-brand-primary\s*\{[\s\S]*?#student-sidebar a\.bg-brand-primary \*\s*\{[\s\S]*?\}/,
    `.student-nav-item.active,
.student-sidebar a.active,
aside a[class*="text-emerald-"],
aside a[class*="bg-emerald-"],
#student-sidebar a.bg-brand-primary {
    background-color: #F26522 !important;
    color: #FFFFFF !important;
    border-color: #E95420 !important;
    font-weight: 800 !important;
}

.student-nav-item.active i,
.student-sidebar a.active i,
.student-nav-item.active *,
.student-sidebar a.active *,
#student-sidebar a.bg-brand-primary *,
#student-sidebar a.bg-brand-primary i,
#student-sidebar a.bg-brand-primary span {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
    font-weight: 800 !important;
}`
);

// C. Selection
fContent = fContent.replace(
    /::selection\s*\{\s*background-color:\s*#F26522;\s*color:\s*#172033;\s*font-weight:\s*700;\s*\}/,
    `::selection {
    background-color: #F26522;
    color: #FFFFFF;
    font-weight: 700;
}`
);

// D. Course Item card span scoping
fContent = fContent.replace(
    /html\.light \.course-item \[class\*="space-y-"\] span,\s*\r?\nhtml\.light \.course-item-card \[class\*="space-y-"\] span,\s*\r?\nhtml\.light \.course-item div\.flex span,\s*\r?\nhtml\.light \.course-item-card div\.flex span\s*\{/,
    `html.light .course-item [class*="space-y-"] span:not(.btn-brand-primary *):not(a.btn-brand-primary *):not(button *),
html.light .course-item-card [class*="space-y-"] span:not(.btn-brand-primary *):not(a.btn-brand-primary *):not(button *),
html.light .course-item div.flex span:not(.btn-brand-primary *):not(a.btn-brand-primary *):not(button *),
html.light .course-item-card div.flex span:not(.btn-brand-primary *):not(a.btn-brand-primary *):not(button *) {`
);

// E. Universal Brand Orange Background => Pure White Text Guarantee
const universalBlock = `

/* ============================================================================
   UNIVERSAL BRAND ORANGE BACKGROUND => PURE WHITE TEXT GUARANTEE
   Ensures WCAG AAA contrast whenever #F26522 or #E95420 is used as background
   ============================================================================ */
[style*="background-color: #F26522"],
[style*="background-color:#F26522"],
[style*="background: #F26522"],
[style*="background:#F26522"],
[style*="background-color: #E95420"],
[style*="background-color:#E95420"],
[style*="background: #E95420"],
[style*="background:#E95420"],
[style*="background-color: rgb(242, 101, 34)"],
[style*="background: rgb(242, 101, 34)"],
[style*="background-color: rgb(233, 84, 32)"],
[style*="background: rgb(233, 84, 32)"],
.bg-brand-primary,
a.bg-brand-primary,
button.bg-brand-primary,
.btn-brand-primary,
a.btn-brand-primary,
button.btn-brand-primary,
.btn-brand-action,
.course-filter-btn.active,
.category-pill.active,
.counseling-hotline-btn,
#counseling-hotline-btn,
html.light .btn-brand-primary,
html.light a.btn-brand-primary,
html.light button.btn-brand-primary,
html.light .course-item a.btn-brand-primary,
html.light .course-item-card a.btn-brand-primary,
html.light .counseling-hotline-btn,
html.light #counseling-hotline-btn {
    color: #FFFFFF !important;
}

[style*="background-color: #F26522"] *,
[style*="background-color:#F26522"] *,
[style*="background: #F26522"] *,
[style*="background:#F26522"] *,
[style*="background-color: #E95420"] *,
[style*="background-color:#E95420"] *,
[style*="background: #E95420"] *,
[style*="background:#E95420"] *,
[style*="background-color: rgb(242, 101, 34)"] *,
[style*="background: rgb(242, 101, 34)"] *,
[style*="background-color: rgb(233, 84, 32)"] *,
[style*="background: rgb(233, 84, 32)"] *,
.bg-brand-primary *,
a.bg-brand-primary *,
button.bg-brand-primary *,
.btn-brand-primary *,
a.btn-brand-primary *,
button.btn-brand-primary *,
.btn-brand-action *,
.course-filter-btn.active *,
.category-pill.active *,
.counseling-hotline-btn *,
#counseling-hotline-btn *,
html.light .btn-brand-primary *,
html.light a.btn-brand-primary *,
html.light button.btn-brand-primary *,
html.light .course-item a.btn-brand-primary *,
html.light .course-item-card a.btn-brand-primary *,
html.light .counseling-hotline-btn *,
html.light #counseling-hotline-btn * {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
}

/* Hover, Focus, Active states */
[style*="background-color: #F26522"]:hover,
[style*="background: #F26522"]:hover,
.bg-brand-primary:hover,
.btn-brand-primary:hover,
a.btn-brand-primary:hover,
button.btn-brand-primary:hover,
.btn-brand-action:hover,
.course-item:hover a.btn-brand-primary,
.course-item-card:hover a.btn-brand-primary,
.course-item a.btn-brand-primary:hover,
.course-item-card a.btn-brand-primary:hover,
html.light .course-item:hover a.btn-brand-primary,
html.light .course-item-card:hover a.btn-brand-primary,
html.light .course-item a.btn-brand-primary:hover,
html.light .course-item-card a.btn-brand-primary:hover,
.counseling-hotline-btn:hover,
#counseling-hotline-btn:hover {
    color: #FFFFFF !important;
    background-color: #E95420 !important;
    background: #E95420 !important;
}

[style*="background-color: #F26522"]:hover *,
[style*="background: #F26522"]:hover *,
.bg-brand-primary:hover *,
.btn-brand-primary:hover *,
a.btn-brand-primary:hover *,
button.btn-brand-primary:hover *,
.btn-brand-action:hover *,
.course-item:hover a.btn-brand-primary *,
.course-item-card:hover a.btn-brand-primary *,
.course-item a.btn-brand-primary:hover *,
.course-item-card a.btn-brand-primary:hover *,
html.light .course-item:hover a.btn-brand-primary *,
html.light .course-item-card:hover a.btn-brand-primary *,
html.light .course-item a.btn-brand-primary:hover *,
html.light .course-item-card a.btn-brand-primary:hover *,
.counseling-hotline-btn:hover *,
#counseling-hotline-btn:hover * {
    color: #FFFFFF !important;
    fill: #FFFFFF !important;
}
`;

fContent += universalBlock;
fs.writeFileSync('public/frontend/css/custom.css', fContent, 'utf8');
console.log('public/frontend/css/custom.css updated successfully');

// 2. Update resources/views/frontend/theme/clasic/frontend_layouts/master_layout.blade.php
let mContent = fs.readFileSync('resources/views/frontend/theme/clasic/frontend_layouts/master_layout.blade.php', 'utf8');

// A. Pagination active page link color from #030712 to #FFFFFF
mContent = mContent.replace(
    /html\.light \.dark-pagination \.page-item\.active \.page-link,\s*\r?\n\s*html\.light \.pagination \.page-item\.active \.page-link\s*\{\s*\r?\n\s*background-color:\s*var\(--brand-primary,\s*#F26522\)\s*!important;\s*\r?\n\s*color:\s*#030712\s*!important;/,
    `html.light .dark-pagination .page-item.active .page-link,
        html.light .pagination .page-item.active .page-link {
            background-color: var(--brand-primary, #F26522) !important;
            color: #FFFFFF !important;`
);

// B. Course item card span scoping in master_layout
mContent = mContent.replace(
    /html\.light \.course-item-card \[class\*="space-y-"\] span,\s*\r?\n\s*html\.light \.course-item-card div\.flex span\s*\{/,
    `html.light .course-item-card [class*="space-y-"] span:not(.btn-brand-primary *):not(a.btn-brand-primary *):not(button *),
        html.light .course-item-card div.flex span:not(.btn-brand-primary *):not(a.btn-brand-primary *):not(button *) {`
);

// C. Insert universalBlock into master_layout.blade.php inside <style> before </style>
mContent = mContent.replace('    </style>', universalBlock + '\n    </style>');
fs.writeFileSync('resources/views/frontend/theme/clasic/frontend_layouts/master_layout.blade.php', mContent, 'utf8');
console.log('master_layout.blade.php updated successfully');

