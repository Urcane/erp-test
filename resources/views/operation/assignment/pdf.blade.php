<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/css" media="print">
        @page {
            size: auto;
            margin-top: 0mm;
            margin-bottom: 0mm;
            margin-right: 5mm;
            margin-left: 5mm;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

@php
    $diff = date_diff(date_create($assignment->start_date), date_create($assignment->end_date))->format('%a') + 1;
@endphp

<body>
    <div class="max-w-[210mm] text-lg">
        <div class="items-center justify-center mt-4 flex">
            <div class="mr-7">
                <img src="{{ asset('/sense/media/logos/logo-comtel.png') }}" class="h-[110px]" />
            </div>
            <div class="mx-4 text-center text-base">
                <div>
                    <p class="font-bold text-xl p-0 m-[-8px]">PT. COMTELINDO</p>
                    <p class="p-0 m-[-8px]">Jl. Let Kol. Pol. HM. Asnawi Arbain RT.30 No.161 Kelurahan Sungai</p>
                    <p class="p-0 m-[-8px]">Nangka Kecamatan Balikpapan Selatan 76114, Telepon: 0542 8706777</p>
                    <p class="p-0 m-[-8px]">Website : <a class="underline decoration-blue-600"
                            href="www.comtelindo.com">www.comtelindo.com</a></p>
                    <p class="p-0 m-[-8px]">Email : <a class="underline decoration-blue-600"
                            href="mailto: info@comtelindo.com">info@comtelindo.com</a></p>
                </div>
            </div>
        </div>

        <hr class="border-1 border-black mt-1" />
        <hr class="border-2 border-black mt-1" />

        <div class="mt-3 mb-12">
            <div class="text-center">
                <p class="underline decoration-2 font-semibold text-2xl">SURAT TUGAS</p>
                <p>{{ $assignment->number }}</p>
            </div>

            <div class="mt-4">
                <div>
                    <span class="mr-40">Perihal</span>
                    : Surat Tugas Perjalanan Dinas
                </div>
                <div>
                    <span class="mr-7">Durasi Perjalanan Dinas</span>
                    :
                    {{ $diff }}
                    ({{ str_replace(
                        ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                        ['nol', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan'],
                        $diff,
                    ) }})
                    Hari
                </div>
                <div>
                    <span class="mr-[137px]">Lokasi PD</span>
                    : {{ $assignment->location }}
                </div>
            </div>

            <div class="mt-6">
                <p>Yang bertanda tangan dibawah ini :</p>
                <div>
                    <span class="mr-12">Nama</span>
                    : {{ $signed['name'] }}
                </div>
                <div>
                    <span class="mr-[35px]">Jabatan</span>
                    : {{ $signed['position'] }}
                </div>
                <div>
                    <span class="mr-[68px]">NIK</span>
                    : {{ $signed['nik'] }}
                </div>
            </div>

            <div class="mt-8">
                <p>Bersamaan dengan ini, kami memberikan Tugas Dinas kepada :</p>
                <div>
                    <span class="mr-12">Nama</span>
                    : {{ $user['name'] }}
                </div>
                <div>
                    <span class="mr-[35px]">Jabatan</span>
                    : {{ $user['position'] }}
                </div>
                <div>
                    <span class="mr-[68px]">NIK</span>
                    : {{ $user['nik'] }}
                </div>
            </div>

            <div class="mt-6">
                <p>
                    untuk {{ $assignment->purpose }} dengan durasi kerja
                    <span class="font-bold">
                        {{ date('d M Y', strtotime($assignment->start_date)) }}
                        s.d
                        {{ date('d M Y', strtotime($assignment->end_date)) }}
                    </span>
                </p>
            </div>

            <div class="mt-6">
                <p>Demikian surat Perintah Kerja ini kami sampaikan, atas perhatian dan kerja samanya kami ucapkan
                    terima kasih.</p>
            </div>

            <div class="mt-9">
                <div class="flex flex-1 justify-end">
                    <div class="text-center">
                        <p>Balikpapan, {{ $assignment->created_at->format('d M Y') }}</p>
                        <p class="font-bold">PT. COMTELINDO</p>
                        <img class="h-[120px]"
                            src="{{ asset('sense/media/sign_pegawai/1DWvxMPiicE5VFWY8nlzKyvTguVS18qTtXvWf3Mg.png') }}"
                            alt="ttd" />
                        <p class="uppercase">{{ $signed['name'] }}</p>
                        <p class="font-bold uppercase">{{ $user['position'] }}</p>
                    </div>

                </div>
            </div>
        </div>

        <hr class="border-2 border-black mt-1" />
        <hr class="border-1 border-black mt-1" />

        <p class="text-[12px] text-center mt-1">Dedicated Internet | Broadband Internet | Connectivity Services | Voice
            Services | IT Solutions | VoIP | Call Center | GPS Tracking</p>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", (event) => {
            window.print();
        });
    </script>
</body>

</html>
