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

<body>
    <div class="max-w-[210mm] mt-[18mm] text-[7px]" style="font-family: Verdana, sans-serif;">
        <div class="mx-10 border border-2 border-cyan-700">
            <div class="mx-4">
                <div class="justify-center mt-5 mb-2 flex">
                    <div class="mr-7 grow">
                        <img src="{{ asset('/sense/media/logos/logo-full-30-org.png') }}" class="h-[40px]" />
                        <p class="text-[16px] ml-52 text-gray-400" style="font-family: 'Book Antiqua', serif;">SALES
                            RECEIPT</p>
                    </div>
                    <div class="text-end">
                        <div class="mt-5"></div>
                        <div>
                            <p>Date: 02 Oktober 2023</p>
                            <p>Receipt : 034/KW/CMT/X/2023</p>
                        </div>
                        <div class="mt-8"></div>
                        <div>
                            <p><span class="text-gray-400 text-[8px] mr-16">Sold To</span> PT. PERTAMINA EP</p>
                            <p class="text-gray-400">[Company Name]</p>
                            <p>MENARA STANDAR CHARTERED</p>
                            <p>LT. 21-29 JL. PROF. DR. SATRIO</p>
                            <p>NO. 164 SETIABUDI - JAKARTA</p>
                            <p>SELATAN - DKI JAKARTA RAYA</p>
                            <p class="text-gray-400">[Phone]</p>
                            <p>Customer ID :P210518 - PEP</p>
                        </div>
                    </div>
                </div>

                <table class="min-w-full text-[9px] table-fixed mt-4">
                    <thead>
                        <tr class="text-white bg-cyan-700 italic text-left">
                            <th class="border border-cyan-700 border-r-white">
                                <div class="font-bold ml-1">Payment Method</div>
                            </th>
                            <th class="border-y border-cyan-700">
                                <div class="font-bold ml-1">Internet Package</div>
                            </th>
                            <th class="border border-cyan-700 border-l-white">
                                <div class="font-bold ml-1">Access Period</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-x border-b border-gray-300">
                                <p class="ml-1">
                                    Cash/Transfer
                                </p>
                            </td>
                            <td class="border-b border-gray-300">
                                <p class="ml-1">
                                    -
                                </p>
                            </td>
                            <td class="border-x border-b border-gray-300">
                                <p class="ml-1">
                                    01/04/2023 - 30/04/2023
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="min-w-full text-[9px] table-fixed mt-3">
                    <thead>
                        <tr class="grid grid-cols-12 text-white bg-cyan-700 italic">
                            <th class="col-span-1 border border-cyan-700 border-r-white">
                                <div class="font-bold ml-1">No</div>
                            </th>
                            <th class="col-span-5 border-y border-r border-cyan-700 border-r-white">
                                <div class="font-bold ml-1">Description</div>
                            </th>
                            <th class="col-span-2 border-y border-r border-cyan-700 border-r-white">
                                <div class="font-bold ml-1">Unit Price</div>
                            </th>
                            <th class="col-span-2 border-y border-r border-cyan-700 border-r-white">
                                <div class="font-bold ml-1">Discount</div>
                            </th>
                            <th class="col-span-2 border-r border-y border-cyan-700">
                                <div class="font-bold ml-1">Line Total</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-1 border-x border-t border-gray-400 justify-center items-center flex">
                                <div class="ml-1 text-center">1</div>
                            </td>
                            <td class="col-span-5 border-t border-r border-gray-400">
                                <div class="ml-1">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, pariatur, quam iusto
                                    aut tenetur quisquam nostrum nisi eos debitis molestiae, tempore accusantium alias
                                    beatae fugiat quasi cupiditate culpa hic reprehenderit.
                                </div>
                            </td>
                            <td class="col-span-2 border-t border-r border-gray-400 justify-center items-center flex">
                                <div class="ml-1">Rp. 41.231.333,-</div>
                            </td>
                            <td class="col-span-2 border-t border-r border-gray-400 justify-center items-center flex">
                                <div class="ml-1">-</div>
                            </td>
                            <td class="col-span-2 border-r border-gray-400 justify-center items-center flex">
                                <div class="ml-1">Rp. 41.231.333,-</div>
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-1 border-x border-gray-400 justify-center items-center flex">
                                <div class="ml-1 text-center">2</div>
                            </td>
                            <td class="col-span-5 border-r border-gray-400">
                                <div class="ml-1">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, pariatur, quam iusto
                                    aut tenetur quisquam nostrum nisi eos debitis molestiae, tempore accusantium alias
                                    beatae fugiat quasi cupiditate culpa hic reprehenderit.
                                </div>
                            </td>
                            <td class="col-span-2 border-r border-gray-400 justify-center items-center flex">
                                <div class="ml-1">Rp. 41.231.333,-</div>
                            </td>
                            <td class="col-span-2 border-r border-gray-400 justify-center items-center flex">
                                <div class="ml-1">-</div>
                            </td>
                            <td class="col-span-2 border-r border-gray-400 justify-center items-center flex">
                                <div class="ml-1">Rp. 41.231.333,-</div>
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 bg-gray-200 text-[8px]">
                            <td
                                class="col-span-1 border-b border-x border-gray-400 justify-center items-center flex min-h-[15px]">
                                <div class="ml-1 text-center"></div>
                            </td>
                            <td class="col-span-5 border-b border-r border-gray-400">
                                <div class="ml-1">

                                </div>
                            </td>
                            <td
                                class="col-span-2 border-b border-r border-gray-400 justify-center items-center flex min-h-[15px]">
                                <div class="ml-1"></div>
                            </td>
                            <td
                                class="col-span-2 border-b border-r border-gray-400 justify-center items-center flex min-h-[15px]">
                                <div class="ml-1"></div>
                            </td>
                            <td
                                class="col-span-2 border-r border-gray-400 justify-center items-center flex min-h-[15px]">
                                <div class="ml-1"></div>
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-6">
                            </td>
                            <td class="col-span-2 border-r border-gray-400">
                                <p class="mr-2 text-end font-bold italic">Total Discount</p>
                            </td>
                            <td class="col-span-2 border-b border-r border-gray-400 justify-between items-center flex">
                                {{-- <div class="ml-3">Rp</div>
                                <div class="mr-1">4.123.521,-</div> --}}
                            </td>
                            <td class="col-span-2 border-b border-r border-t border-gray-400 justify-between items-center flex">
                                {{-- <div class="ml-3">Rp</div>
                                <div class="mr-1">4.123.521,-</div> --}}
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-8">
                            </td>
                            <td class="col-span-2 border-r border-gray-400">
                                <p class="mr-2 text-end font-bold italic">Subtotal</p>
                            </td>
                            <td class="col-span-2 border-b border-r border-gray-400 justify-between items-center flex">
                                <div class="ml-3">Rp</div>
                                <div class="mr-1">4.123.521,-</div>
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-8">
                            </td>
                            <td class="col-span-2 border-r border-gray-400">
                                <p class="mr-2 text-end font-bold italic">Sales Tax (11%)</p>
                            </td>
                            <td
                                class="col-span-2 border-b border-r border-gray-400 justify-between items-center flex bg-gray-200">
                                <div class="ml-3">Rp</div>
                                <div class="mr-1">4.123.521,-</div>
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-8">
                            </td>
                            <td class="col-span-2 border-r border-gray-400">
                                <p class="mr-2 text-end font-bold italic">Biaya Material</p>
                            </td>
                            <td
                                class="col-span-2 border-b border-r border-gray-400 justify-between items-center flex bg-gray-200">
                                <div class="ml-3">Rp</div>
                                <div class="mr-1">4.123.521,-</div>
                            </td>
                        </tr>

                        <tr class="grid grid-cols-12 text-[8px]">
                            <td class="col-span-8">
                            </td>
                            <td class="col-span-2 border-r border-gray-400">
                                <p class="mr-2 text-end font-bold italic">Total</p>
                            </td>
                            <td class="col-span-2 border-b border-r border-gray-400 justify-between items-center flex">
                                <div class="ml-3">Rp</div>
                                <div class="mr-1">4.123.521,-</div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <div class="text-[8px] mt-3 text-center">
                    <p>Terbilang :
                        <span class="font-bold">"Empat Empat Empat Empat Empat puluh enam juta seratus delapan puluh
                            ribu
                            sembilan ratus dua puluh
                            delapan Rupiah"
                        </span>
                    </p>
                </div>

                <div class="mt-4 text-[8px] leading-3">
                    <p class="font-bold">
                        Mohon untuk dicantumkan nomor Invoice saat melakukan pembayaran dan melakukan konfirmasi ke
                        billing@comtelindo.com
                    </p>
                    <p class="italic">
                        Please add number of Invoice when making payment at transfer description and send email to
                        billing@comtelindo.com for confirmation
                    </p>
                    <p class="font-bold">
                        Jika Anda membutuhkan informasi lain, silahkan hubungi kami ke e-mail kami: info@comtelindo.com,
                        atau hubungi kami di (0542) 8706777
                    </p>
                    <p class="italic">
                        If you need more information, contact us to e-mail: <a href="mailto:info@comtelindo.com"
                            class="text-blue-500 underline underline-blue-500">info@comtelindo.com</a> , or call at
                        (0542) 8706777
                    </p>
                </div>

                <div class="mt-3 text-[8px] leading-3">
                    <p class="font-bold">Pembayaran Transfer / Transfer Payment</p>
                    <p class="font-bold">IDR Account</p>
                    <div class="flex">
                        <p>Name</p>
                        <p class="ml-[66px]">: </p>
                        <p class="font-bold ml-3">PT. Comtelindo</p>
                    </div>
                    <div class="flex">
                        <p>Bank Name</p>
                        <p class="ml-11">: </p>
                        <p class="ml-3">Bank Mandiri, KCP Balikpapan Baru</p>
                    </div>
                    <div class="flex">
                        <p>Account No.</p>
                        <p class="ml-[41px]">: </p>
                        <p class="ml-3 font-bold">PT. Comtelindo</p>
                    </div>
                </div>

                <div class="mt-4 mb-4 text-[8px] leading-3">
                    <p>Sincerely yours,</p>
                    <p class="font-bold">PT. COMTELINDO</p>
                    <div class="mb-24"></div>
                    <p>Yogi Purwoko</p>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            window.print();
        });
    </script>
</body>

</html>
