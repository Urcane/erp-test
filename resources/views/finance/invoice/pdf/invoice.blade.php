<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <div class="max-w-[198mm] mt-[10mm] text-lg">
        <div class="mx-[12mm]">
            <div class="items-center justify-center mt-7 mb-2 flex">
                <div class="mr-7 grow">
                    <img src="{{ asset('/sense/media/logos/logo-full-30.png') }}" class="h-[40px]" />
                </div>
                <div class="mx-4 text-end text-sm">
                    <div>
                        <p class="font-bold underline decoration-1 text-[14px] p-0 mx-[-14px]">TAGIHAN PEMAKAIAN JASA
                            COMTELINDO</p>
                        <p class="mx-[-14px] text-[14px] italic">INVOICE</p>
                    </div>
                </div>
            </div>

            <hr class="border-1 border-black mt-1" />
            <hr class="border-2 border-black mt-1" />

            <div class="mt-3 mb-5 text-[9px] grid grid-cols-6">
                <div>
                    <div class="text-center bg-gray-400 border border-black">
                        <div class="font-bold underline">NO PELANGGAN</div>
                        <div class="italic mt-[-15px]">CUSTOMER ID</div>
                    </div>
                    <div class="text-center border-x border-b border-black flex justify-center items-center">
                        <p class="text-[8px]">E120205-NDT</p>
                    </div>
                </div>

                <div>
                    <div class="text-center bg-gray-400 border-y border-black">
                        <div class="font-bold underline">NO TAGIHAN</div>
                        <div class="italic mt-[-15px]">INVOICE NUMBER</div>
                    </div>
                    <div class="text-center border-b border-black flex justify-center items-center">
                        <p class="text-[8px]">298/INV/COMTEL/VI/2023</p>
                    </div>
                </div>

                <div>
                    <div class="text-center bg-gray-400 border border-black">
                        <div class="font-bold underline">TANGGAL TAGIHAN</div>
                        <div class="italic mt-[-15px]">INVOICE DATE</div>
                    </div>
                    <div class="text-center border-x border-b border-black flex justify-center items-center">
                        <p class="text-[8px]">02 Juni 2023</p>
                    </div>
                </div>

                <div>
                    <div class="text-center bg-gray-400 border-y border-black">
                        <div class="font-bold underline">PERIODE AKSES</div>
                        <div class="italic mt-[-15px]">ACCESS PERIODE</div>
                    </div>
                    <div class="text-center border-b border-black flex justify-center items-center">
                        <p class="text-[8px]">01/06/2023 - 30/06/2023</p>
                    </div>
                </div>

                <div>
                    <div class="text-center bg-gray-400 border border-black">
                        <div class="font-bold underline">TOTAL TAGIHAN</div>
                        <div class="italic mt-[-15px]">TOTAL AMOUNT</div>
                    </div>
                    <div
                        class="text-center border-x border-b border-black flex justify-between items-center text-[8px]">
                        <p class="mr-1 ml-2">Rp</p>
                        <p class="text-end mr-1">33.310.000</p>
                    </div>
                </div>

                <div>
                    <div class="text-center bg-gray-400 border-y border-r border-black">
                        <div class="font-bold underline">JATUH TEMPO</div>
                        <div class="italic mt-[-15px]">DUE DATE</div>
                    </div>
                    <div class="text-center border-b border-r border-black flex justify-center items-center">
                        <p class="text-[8px]">20 Juni 2023</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between text-[9px]">
                <div>
                    <div class="mt-[-17px] font-bold">Kepada / Bill To</div>
                    <div class="mt-[-17px] font-bold">PT. PERTAMINA EP</div>
                    <div class="mt-[-17px]">Menara Standard Chartered Lt. 21-29</div>
                    <div class="mt-[-17px]">Jl. Prof. Dr. Satrio No.164</div>
                    <div class="mt-[-17px]">Setiabudi, Jakarta Selatan, DKI Jakarta Raya-12950</div>
                    <div class="mt-[-17px]">NPWP : 02.269.005.0-081.000</div>
                </div>
                <div class="text-end">
                    <div class="mt-[-17px] font-bold">PT. COMTELINDO</div>
                    <div class="mt-[-17px]">Jl. Letkol. Pol. HM Asnawi Arbain</div>
                    <div class="mt-[-17px]">No. 161 Rt. 30 Kel. Sungai Nangka </div>
                    <div class="mt-[-17px]">Kec. Balikpapan Selatan </div>
                    <div class="mt-[-17px]">Kota Balikpapan 76114</div>
                    <div class="mt-[-17px]">NPWP : 03.013.447.2-721.000</div>
                </div>
            </div>

            <hr class="border-1 border-black mt-6" />

            <div class="text-[9px] flex justify-center mt-[-6px] mb-[-4px]">
                <div class="font-bold mr-1">Metode Pembayaran -</div>
                <div class="mr-1 italic">Payment Method :</div>
                <div class="font-bold">Cash</div>
            </div>

            <table class="min-w-full text-[9px]">
                <thead>
                    <tr class="grid grid-cols-10">
                        <th class="border border-black text-center justify-center">
                            <div class="font-bold underline mt-[-6px]">TANGGAL</div>
                            <div class="italic mt-[-15px] mb-[-6px]">DATE</div>
                        </th>
                        <th class="col-span-7 border-y border-black text-center justify-center">
                            <div class="font-bold underline mt-[-6px]">KETERANGAN</div>
                            <div class="italic mt-[-15px] mb-[-6px]">DESCRIPTION</div>
                        </th>
                        <th class="col-span-2 border border-black text-center justify-center">
                            <div class="font-bold underline mt-[-6px]">JUMLAH (IDR)</div>
                            <div class="italic mt-[-15px] mb-[-6px]">AMOUNT (IDR)</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="grid grid-cols-10">
                        <td class="border-x border-black pb-3"></td>
                        <td class="col-span-7">
                        </td>
                        <td class="col-span-2 border-x border-black">
                        </td>
                    </tr>

                    <tr class="grid grid-cols-10">
                        <td class="border-x border-black text-center pb-6">2-Jun-23</td>
                        <td class="col-span-7 pb-6">
                            <div class="leading-3">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem magnam debitis
                                pariatur temporibus
                                voluptatum, at, iure velit natus reprehenderit excepturi ad nemo magni quam culpa et
                                quod totam maiores
                                necessitatibus?Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem magnam debitis
                            </div>
                        </td>
                        <td class="col-span-2 border-x border-black text-center justify-center flex justify-between pb-6">
                            <p class="mx-1">Rp</p>
                            <p class="text-end mr-1">33.310.000</p>
                        </td>
                    </tr>
                    <tr class="grid grid-cols-10">
                        <td class="border-x border-black text-center pb-6">2-Jun-23</td>
                        <td class="col-span-7">
                            <div class="leading-3 pb-6">
                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatem magnam debitis
                                pariatur temporibus
                                voluptatum, at, iure velit natus reprehenderit excepturi ad nemo magni quam culpa et
                                quod totam maiores
                                necessitatibus?
                            </div>
                        </td>
                        <td class="col-span-2 border-x border-black text-center justify-center flex justify-between pb-6">
                            <p class="mx-1">Rp</p>
                            <p class="text-end mr-1">33.310.000</p>
                        </td>
                    </tr>

                    <tr class="grid grid-cols-10 font-bold">
                        <td class="border-x border-t border-black text-center justify-center"></td>
                        <td class="col-span-7 border-t border-black">
                            <div class="ml-2 my-[-8px] p-0 font-bold">Total</div>
                        </td>
                        <td class="col-span-2 border-x border-t border-black text-center justify-center flex justify-between">
                            <p class="mx-1 my-[-8px] p-0">Rp</p>
                            <p class="text-end mr-1 my-[-8px] p-0">33.310.000</p>
                        </td>
                    </tr>
                    <tr class="grid grid-cols-10 font-bold">
                        <td class="border-x border-black text-center justify-center"></td>
                        <td class="col-span-7">
                            <div class="ml-2 my-[-8px] p-0">PPN/VAT (11%)</div>
                        </td>
                        <td class="col-span-2 border-x border-black text-center justify-center flex justify-between">
                            <p class="mx-1 my-[-8px] p-0">Rp</p>
                            <p class="text-end mr-1 my-[-8px] p-0">33.310.000</p>
                        </td>
                    </tr>
                    <tr class="grid grid-cols-10 font-bold">
                        <td class="border-x border-b border-black text-center justify-center"></td>
                        <td class="col-span-7 border-b border-black text-center italic">
                            <p class="my-[-8px]">CURRENT INVOICE</p>
                        </td>
                        <td class="col-span-2 border border-black text-center justify-center flex justify-between">
                            <p class="mx-1 my-[-8px]">Rp</p>
                            <p class="text-end mr-1 my-[-8px]">33.310.000</p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="grid grid-cols-12 text-[9px] mt-4">
                <div class="col-span-3"></div>
                <div class="col-span-2 leading-3">Terbilang /<span class="italic">In Word :</span></div>
                <div class="col-span-7 ml-[-25px] italic text-[10px] font-bold leading-3">
                    Empat puluh enam juta seratus delapan puluh ribu sembilan ratus dua puluh delapan Rupiah
                </div>
            </div>

            <div class="mt-5 text-[9px] leading-3">
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

            <div class="mt-3 text-[9px] leading-3">
                <p class="font-bold">
                    Mohon untuk dicantumkan nomor Invoice saat melakukan pembayaran dan melakukan konfirmasi ke billing@comtelindo.com
                </p>
                <p class="italic">
                    Please add number of Invoice when making payment at transfer description and send email to billing@comtelindo.com for confirmation
                </p>
                <p class="font-bold">
                    Jika Anda membutuhkan informasi lain, silahkan hubungi kami ke e-mail kami: info@comtelindo.com, atau hubungi kami  di (0542) 8706777
                </p>
                <p class="italic">
                    If you need more information, contact  us to e-mail: <a href="mailto:info@comtelindo.com" class="text-blue-500 underline underline-blue-500">info@comtelindo.com</a> , or call at (0542) 8706777
                </p>
            </div>

            <div class="mt-4 text-[9px] leading-3">
                <p>Sincerely yours,</p>
                <p>PT. Comtelindo</p>
                <div class="mb-24"></div>
                <p>Yogi Purwoko</p>
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
