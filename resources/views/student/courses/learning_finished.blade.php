{{-- hasil ujian yg sudah di kerjakan --}}
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="content">
        <div class="border-b border-[#EEEEEE]">
            <div class="nav flex items-center w-full h-[92px] max-w-[1280px] mx-auto justify-between p-5">
                <div class="flex items-center gap-4">
                    <div class="w-[50px] h-[50px] flex shrink-0 overflow-hidden rounded-full">
                        <img src="{{ Storage::url($course->cover) }}" class="object-cover" alt="thumbnail">
                    </div>
                    <div class="flex flex-col gap-[2px]">
                        <p class="font-bold text-lg">{{ $course->name }}</p>
                        <p class="text-[#7F8190] text-sm">Beginners</p>
                    </div>
                </div>
                <div class="flex gap-3 items-center">
                    <div class="flex flex-col text-right">
                        <p class="text-sm text-[#7F8190]">Howdy</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-[46px] h-[46px]">
                        <img src="{{ asset('images/photos/default-photo.svg') }}" alt="photo">
                    </div>
                </div>
            </div>
        </div>
        <div class="finished flex flex-col gap-[40px] items-center justify-center mt-[120px] mb-[30px] w-full">
            <div class="w-[200px] h-[200px] flex shrink-0 overflow-hidden">
                <img src="{{ asset('images/thumbnail/Web-Development-big.png') }}" class="w-full h-full object-contain"
                    alt="icon">
            </div>
            <div class="flex flex-col gap-[6px] justify-center text-center">
                <h1 class="font-bold text-2xl">Congratulations! <br>You Have Finished Test</h1>
                <p class="text-[#7F8190] w-[374px]">Hopefully you will get a better result to prepare your great future
                    career soon enough</p>
            </div>
            <a href="{{ route('dashboard.learning.rapport.course', $course) }}"
                class="w-fit p-[14px_30px] bg-[#6436F1] rounded-full font-bold text-sm text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center align-middle">View
                Test Result</a>
        </div>
    </section>

</body>

</html>
