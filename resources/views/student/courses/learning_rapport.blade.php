<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Student</title>
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body class="font-poppins text-[#0A090B]">
    <section id="content" class="flex">
        <div id="sidebar"
            class="w-[270px] flex flex-col shrink-0 min-h-screen justify-between p-[30px] border-r border-[#EEEEEE] bg-[#FBFBFB]">
            <div class="w-full flex flex-col gap-[30px]">
                <h1 style="font-size: 30px" class="text-xl font-bold">AkbarHD</h1>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">DAILY USE</h3>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/home-hashtag.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Overview</p>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 bg-[#2B82FE] transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/note-favorite.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold text-white transition-all duration-300 hover:text-white">Courses</p>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/crown.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Certificates</p>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/sms-tracking.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Messages</p>
                            <div
                                class="notif w-5 h-5 flex shrink-0 rounded-full items-center justify-center bg-[#F6770B]">
                                <p class="font-bold text-[10px] leading-[15px] text-white">12</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/profile-2user.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Portfolio</p>
                        </a>
                    </li>
                </ul>
                <ul class="flex flex-col gap-3">
                    <li>
                        <h3 class="font-bold text-xs text-[#A5ABB2]">OTHERS</h3>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/3dcube.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Rewards</p>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/code.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">A.I Plugins</p>
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                            <div>
                                <img src="{{ asset('images/icons/setting-2.svg') }}" alt="icon">
                            </div>
                            <p class="font-semibold transition-all duration-300 hover:text-white">Settings</p>
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full p-[10px_16px] flex items-center gap-[14px] rounded-full h-11 transition-all duration-300 hover:bg-[#2B82FE]">
                                <div>
                                    <img src="{{ asset('images/icons/security-safe.svg') }}" alt="icon">
                                </div>
                                <p class="font-semibold transition-all duration-300 hover:text-white">Logout</p>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div id="menu-content" class="flex flex-col w-full pb-[30px]">
            <div class="nav flex justify-between p-5 border-b border-[#EEEEEE]">
                <form
                    class="search flex items-center w-[400px] h-[52px] p-[10px_16px] rounded-full border border-[#EEEEEE]">
                    <input type="text"
                        class="font-semibold placeholder:text-[#7F8190] placeholder:font-normal w-full outline-none"
                        placeholder="Search by report, student, etc" name="search">
                    <button type="submit" class="ml-[10px] w-8 h-8 flex items-center justify-center">
                        <img src="{{ asset('images/icons/search.svg') }}" alt="icon">
                    </button>
                </form>
                <div class="flex items-center gap-[30px]">
                    <div class="flex gap-[14px]">
                        <a href=""
                            class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{ asset('images/icons/receipt-text.svg') }}" alt="icon">
                        </a>
                        <a href=""
                            class="w-[46px] h-[46px] flex shrink-0 items-center justify-center rounded-full border border-[#EEEEEE]">
                            <img src="{{ asset('images/icons/notification.svg') }}" alt="icon">
                        </a>
                    </div>
                    <div class="h-[46px] w-[1px] flex shrink-0 border border-[#EEEEEE]"></div>
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
            <div class="flex flex-col gap-10 px-5 mt-5">
                <div class="breadcrumb flex items-center gap-[30px]">
                    <a href="{{ route('dashboard') }}"
                        class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">Home</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="{{ route('dashboard.learning.index') }}"
                        class="text-[#7F8190] last:text-[#0A090B] last:font-semibold">My Courses</a>
                    <span class="text-[#7F8190] last:text-[#0A090B]">/</span>
                    <a href="#" class="text-[#7F8190] last:text-[#0A090B] last:font-semibold ">Rapport
                        Details</a>
                </div>
            </div>
            <div class="header ml-[70px] pr-[70px] w-[940px] flex items-center justify-between mt-10">
                <div class="flex gap-6 items-center">
                    <div class="w-[150px] h-[150px] flex shrink-0 relative overflow-hidden">
                        <img src="{{ Storage::url($course->cover) }}" class="w-full h-full object-contain"
                            alt="icon">
                        <p
                            class="p-[8px_16px] rounded-full bg-[#FFF2E6] font-bold text-sm text-[#F6770B] absolute bottom-0 transform -translate-x-1/2 left-1/2 text-nowrap">
                            {{ $course->Category->name }}</p>
                    </div>
                    <div class="flex flex-col gap-5">
                        <h1 class="font-extrabold text-[30px] leading-[45px]">{{ $course->name }}</h1>
                        <div class="flex items-center">
                            <div class="flex gap-[10px] items-center">
                                <div class="w-6 h-6 flex shrink-0">
                                    <img src="{{ asset('images/icons/note-text.svg') }}" alt="icon">
                                </div>
                                <p class="font-semibold">{{ $correctAnswer }} of {{ $totalQuestion }} correct</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex items-center">
                    @if ($passed)
                        <p
                            class="p-[16px_20px] rounded-[10px] bg-[#06BC65] font-bold text-lg text-white outline-[#06BC65] outline-dashed outline-[3px] outline-offset-[7px] mr-[10px]">
                            Passed</p>
                    @else
                        <p
                            class="p-[16px_20px] rounded-[10px] bg-[#FD445E] font-bold text-lg text-white outline-[#FD445E] outline-dashed outline-[3px] outline-offset-[7px] mr-[10px]">
                            Tidak lulus</p>
                    @endif
                </div>
            </div>
            <div class="result flex flex-col gap-5 mx-[70px] w-[870px] mt-[30px]">

                @forelse ($studentAnswers as $answer)
                    <div
                        class="question-card w-full flex items-center justify-between p-4 border border-[#EEEEEE] rounded-[20px]">
                        <div class="flex flex-col gap-[6px]">
                            <p class="text-[#7F8190]">Question</p>
                            <p class="font-bold text-xl">{{ $answer->question->question }}</p>
                        </div>
                        @if ($answer->answer == 'correct')
                            <div class="flex items-center gap-[14px]">
                                <p class="bg-[#06BC65] rounded-full p-[8px_20px] text-white font-semibold text-sm">
                                    {{ $answer->answer }}</p>
                            </div>
                        @else
                            <div class="flex items-center gap-[14px]">
                                <p class="bg-[#FD445E] rounded-full p-[8px_20px] text-white font-semibold text-sm">
                                    {{ $answer->answer }}</p>
                            </div>
                        @endif
                    </div>
                @empty
                    <p>Belum ada jawaban</p>
                @endforelse

            </div>
            <div class="options flex items-center mx-[70px] gap-5 mt-[30px]">
                <a href=""
                    class="w-fit h-[52px] p-[14px_20px] bg-[#0A090B] rounded-full font-semibold text-white transition-all duration-300 text-center">Request
                    Retake</a>
                <a href=""
                    class="w-fit h-[52px] p-[14px_20px] bg-[#6436F1] rounded-full font-bold text-white transition-all duration-300 hover:shadow-[0_4px_15px_0_#6436F14D] text-center">Contact
                    Teacher</a>
            </div>
        </div>
    </section>

</body>

</html>
