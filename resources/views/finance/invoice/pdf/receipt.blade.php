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
    <div class="max-w-[198mm] mt-[10mm] text-[7px]" style="font-family: Verdana, sans-serif;">
        <div class="mx-[12mm] border border-2 border-cyan-700">
            <div class="mx-4">
                <div class="justify-center mt-5 mb-2 flex">
                    <div class="mr-7 grow">
                        <img src="{{ asset('/sense/media/logos/logo-full-30-org.png') }}" class="h-[40px]" />
                        <p class="text-[16px] ml-52 text-gray-400" style="font-family: 'Book Antiqua', serif;">SALES RECEIPT</p>
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
                            <td class="border-x border-b border-cyan-700">
                                <p class="ml-1">
                                    Cash/Transfer
                                </p>
                            </td>
                            <td class="border-b border-cyan-700">
                                <p class="ml-1">
                                    -
                                </p>
                            </td>
                            <td class="border-x border-b border-cyan-700">
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
                            <th class="col-span-2 border-r border-cyan-700">
                                <div class="font-bold ml-1">Line Total</div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            <td class="border-x border-b border-cyan-700">
                                <p class="ml-1">
                                    Cash/Transfer
                                </p>
                            </td>
                            <td class="border-b border-cyan-700">
                                <p class="ml-1">
                                    -
                                </p>
                            </td>
                            <td class="border-x border-b border-cyan-700">
                                <p class="ml-1">
                                    01/04/2023 - 30/04/2023
                                </p>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>
