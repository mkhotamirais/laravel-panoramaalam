@props(['bg' => 'bg-white'])

<section class="min-h-[30vh] {{ $bg }}">
    <div class="container py-16">
        <div class="flex flex-col gap-2 items-center justify-center text-center">
            <h1 class="title">{{ __('common.home.contact.big-title') }}</h1>
            <p class="text-lg text-gray-600">{{ __('common.home.contact.description') }}</p>
            <a href="http://api.whatsapp.com/send?phone=6281319573240" class="btn mt-6">
                <x-si-whatsapp class="w-8 h-8" />
                <div class="group-hover:text-orange-500 transition font-semibold text-lg">
                    {{ __('common.common.contact-btn') }}</div>
            </a>
        </div>
    </div>
</section>
