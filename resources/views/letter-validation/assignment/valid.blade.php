<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../" />
    <title>Surat Valid | ERP Comtelindo</title>
    <meta charset="utf-8" />
    <meta name="description" content="ERP Comtelindo DESC" />
    <meta name="keywords" content="ERP Comtelindo" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="ERP Comtelindo by ODS" />
    <meta property="og:url" content="https://app.comtelindo.com" />
    <meta property="og:site_name" content="Comtelindo | ERP Comtelindo" />
    <link rel="canonical" href="https://app.comtelindo.com" />
    <link rel="canonical" href="https://app.comtelindo.com" />
    <link rel="shortcut icon" href="{{ asset('sense') }}/media/logos/favicon.ico" />

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col justify-center items-center">
        <img src="{{ asset('sense/media/logos/logo-full-30.png') }}" alt="Logo" class="mb-8 h-12" />
        <img src="{{ asset('sense/media/images/Valid.svg') }}" alt="Logo" class="mb-8 h-44 md:hidden" />
        <div class="md:flex md:justify-between mb-4 md:items-center">
            <div class="hidden md:block">
                <img src="{{ asset('sense/media/images/Valid.svg') }}" alt="Logo" class="mb-8 h-60" />
            </div>
            <div class="mx-3 md:mx-6 p-6 bg-white border border-gray-200 rounded-lg shadow">
                <div class="text-xl md:text-2xl font-bold">
                    Surat Penugasan Tervalidasi
                </div>
                <p class="text-gray-500 text-sm md:text-base md:mb-4 mb-2 italic">
                    Assignment letter is valid
                </p>
                <div class="flex justify-between">
                    <div class="p-2">
                        <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                            Nama yang ditugaskan
                        </p>
                        <p class="text-xs md:text-sm lg:text-base mb-1">
                            {{ $user['name'] }}
                        </p>
                        <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                            Jabatan
                        </p>
                        <p class="text-xs md:text-sm lg:text-base mb-1">
                            {{ $user['position'] }}
                        </p>
                        <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                            NIK
                        </p>
                        <p class="text-xs md:text-sm lg:text-base mb-1">
                            {{ $user['nik'] }}
                        </p>
                    </div>
                    <div class="ml-6 p-2">
                        <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                            Ditandatangani oleh
                        </p>
                        <p class="text-xs md:text-sm lg:text-base mb-1">
                            {{ $assignment->signedBy->name }}
                        </p>
                        <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                            Durasi Dinas
                        </p>
                        <p class="text-xs md:text-sm lg:text-base mb-1">
                            {{ date('d M Y', strtotime($assignment->start_date)) }}
                            -
                            {{ date('d M Y', strtotime($assignment->end_date)) }}
                        </p>
                        <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                            Lokasi Dinas
                        </p>
                        <p class="text-xs md:text-sm lg:text-base mb-1">
                            {{ $assignment->location }}
                        </p>
                    </div>
                </div>
                <div class="pl-2 pb-2 pr-2">
                    <p class="text-[10px] md:text-xs lg:text-sm text-gray-500 italic">
                        Tujuan Dinas
                    </p>
                    <p class="text-xs md:text-sm lg:text-base mb-1">
                        {{ $assignment->purpose }}
                    </p>
                </div>
            </div>
        </div>

        <p class="text-center text-gray-500 text-sm md:text-base lg:text-lg mb-3">
            Untuk penjelasan lebih lanjut, silahkan menghubungi info@comtelindo.com
        </p>

        <div class="flex items-center space-x-4">
            <a href="mailto: idtellofficial@gmail.com"
                class="bg-amber-500 hover:bg-amber-600 text-white font-bold md:py-3 md:px-6 py-2 px-4 md:text-base text-sm rounded">
                Contact Us
            </a>
            <button onclick="window.location.reload();"
                class="border-2 border-gray-400 text-gray-400 font-bold md:py-2.5 md:px-6 py-1.5 px-4 md:text-base text-sm rounded">
                Reload
            </button>
        </div>
    </div>
</body>
</html>
