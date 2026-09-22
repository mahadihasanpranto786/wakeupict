@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach

@section('maincontent')
<div class="relative w-full overflow-hidden bg-slate-950 min-h-screen pt-32 pb-24">

    <!-- Header Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center sm:text-left">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-mono tracking-wider uppercase mb-4">
            <span>{{ __('frontend.contact.direct_badge') }}</span>
        </div>
        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-4 leading-tight">
            {{ __('frontend.contact.headline') }}
        </h1>
        <p class="text-slate-400 text-base sm:text-lg max-w-2xl">
            {{ __('frontend.contact.subheadline') }}
        </p>
    </div>

    <!-- Main Two-Column Contact Architecture -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            <!-- Left 5 Columns: Headquarters & Direct Channels -->
            <div class="lg:col-span-5 space-y-8">
                
                <div class="p-8 rounded-2xl bg-slate-900/70 border border-slate-800/80 backdrop-blur-xl shadow-2xl">
                    <h3 class="text-xl font-bold text-white mb-6">{{ __('frontend.contact.coordinates') }}</h3>
                    
                    <div class="space-y-6">
                        <!-- Location -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 text-lg flex-shrink-0">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-white">{{ __('frontend.contact.hq_title') }}</h4>
                                <p class="text-slate-400 text-sm mt-1 leading-relaxed">
                                    {{ app_setting('contact_address', __('frontend.contact.hq_address')) }}
                                </p>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 text-lg flex-shrink-0">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-white">{{ __('frontend.contact.email_title') }}</h4>
                                <a href="mailto:{{ app_setting('contact_email', 'info@wakeupict.com') }}" class="text-slate-400 hover:text-emerald-400 text-sm mt-1 inline-block transition-colors">
                                    {{ app_setting('contact_email', 'info@wakeupict.com') }}
                                </a>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-lg flex-shrink-0">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-white">{{ __('frontend.contact.phone_title') }}</h4>
                                <a href="tel:{{ app_setting('contact_phone', '+8801791612121') }}" class="text-slate-400 hover:text-emerald-400 text-sm mt-1 inline-block transition-colors font-mono">
                                    {{ app_setting('contact_phone', '+88 01791612121') }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Operational Hours -->
                    <div class="mt-8 pt-8 border-t border-slate-800/80">
                        <div class="flex items-center justify-between text-xs font-mono text-slate-400">
                            <span>{{ __('frontend.contact.hours_label') }}</span>
                            <span class="text-emerald-400">{{ __('frontend.contact.hours_value') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Live Campus Notice -->
                <div class="p-6 rounded-2xl bg-emerald-500/5 border border-emerald-500/20 text-slate-300 text-sm leading-relaxed">
                    <span class="font-semibold text-emerald-400 font-mono text-xs uppercase block mb-1">{{ __('frontend.contact.campus_tour_title') }}</span>
                    {{ __('frontend.contact.campus_tour_desc') }}
                </div>

            </div>

            <!-- Right 7 Columns: High-Tech Glassmorphic Input Form -->
            <div class="lg:col-span-7">
                <div class="p-8 sm:p-10 rounded-2xl bg-slate-900/80 border border-slate-800 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-2xl font-bold text-white mb-2">{{ __('frontend.contact.form_title') }}</h2>
                    <p class="text-slate-400 text-sm mb-8">{{ __('frontend.contact.form_subtitle') }}</p>

                    <form method="POST" action="{{ route('contact-us-user') }}" enctype="multipart/form-data" class="space-y-6 contactForm">
                        @csrf

                        <!-- Name Input -->
                        <div>
                            <label class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium mb-2">
                                {{ __('frontend.contact.name_label') }}
                            </label>
                            <input type="text" name="name" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-white placeholder-slate-500 text-sm transition-all" placeholder="{{ __('frontend.contact.name_placeholder') }}" data-validation="required" value="{{ old('name') }}" />
                            @error('name')
                                <span class="text-rose-400 text-xs mt-1 block font-mono">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone & Email Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium mb-2">
                                    {{ __('frontend.contact.phone_label') }}
                                </label>
                                <input type="text" name="phone" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-white placeholder-slate-500 text-sm font-mono transition-all" placeholder="{{ __('frontend.contact.phone_placeholder') }}" data-validation="required" value="{{ old('phone') }}" />
                                @error('phone')
                                    <span class="text-rose-400 text-xs mt-1 block font-mono">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium mb-2">
                                    {{ __('frontend.contact.email_label') }}
                                </label>
                                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-white placeholder-slate-500 text-sm transition-all" placeholder="{{ __('frontend.contact.email_placeholder') }}" data-validation="required" value="{{ old('email') }}" />
                                @error('email')
                                    <span class="text-rose-400 text-xs mt-1 block font-mono">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Message Textarea -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium">
                                    {{ __('frontend.contact.message_label') }}
                                </label>
                                <span id="charNum" class="text-[11px] font-mono text-slate-400">200 {{ __('frontend.contact.chars_remaining') }}</span>
                            </div>
                            <textarea name="message" rows="4" onkeyup="countChars(this);" class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-700/80 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-white placeholder-slate-500 text-sm leading-relaxed transition-all resize-none" placeholder="{{ __('frontend.contact.message_placeholder') }}" data-validation="required">{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-rose-400 text-xs mt-1 block font-mono">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- File Upload (Optional) -->
                        <div>
                            <label class="block text-xs font-mono uppercase tracking-wider text-slate-300 font-medium mb-2">
                                {{ __('frontend.contact.file_label') }}
                            </label>
                            <div class="relative flex items-center">
                                <input type="file" id="my-file" name="image" onchange="preview()" class="w-full text-sm text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-mono file:font-semibold file:bg-slate-800 file:text-emerald-400 hover:file:bg-slate-700 file:cursor-pointer cursor-pointer bg-slate-950/80 rounded-xl border border-slate-700/80" />
                            </div>
                            @error('image')
                                <span class="text-rose-400 text-xs mt-1 block font-mono">{{ $message }}</span>
                            @enderror
                            <div class="mt-4 flex justify-center">
                                <img src="" id="previewImg" class="max-h-36 rounded-xl border border-slate-700 shadow-md hidden object-contain">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-4">
                            <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl font-semibold text-sm tracking-wider uppercase bg-emerald-500 hover:bg-emerald-400 text-slate-950 transition-all duration-300 shadow-glow-emerald hover:-translate-y-1 active:translate-y-0">
                                <span>{{ __('frontend.contact.submit_btn') }}</span>
                                <i class="fa fa-paper-plane text-xs"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    function countChars(obj) {
        var maxLength = 200;
        var strLength = obj.value.length;
        var charRemain = (maxLength - strLength);

        if (charRemain < 0) {
            document.getElementById("charNum").innerHTML = '<span class="text-rose-400">Limit exceeded by ' + Math.abs(charRemain) + ' characters</span>';
        } else {
            document.getElementById("charNum").innerHTML = charRemain + ' characters remaining';
        }
    }

    function preview() {
        const file = document.querySelector('#my-file').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function(e) {
            const img = document.querySelector('#previewImg');
            if (img) {
                img.setAttribute('src', e.target.result);
                img.classList.remove('hidden');
            }
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
