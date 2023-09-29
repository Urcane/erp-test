<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        *,
*:before,
*:after {
  box-sizing: border-box;
  border-width: 0;
  border-style: solid;
  border-color: #e5e7eb;
}

*:before,
*:after {
  content: "";
}

html {
  line-height: 1.5;
  -webkit-text-size-adjust: 100%;
  -moz-tab-size: 4;
  -o-tab-size: 4;
  tab-size: 4;
  font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", Segoe UI Symbol, "Noto Color Emoji";
  font-feature-settings: normal;
  font-variation-settings: normal;
}

body {
  margin: 0;
  line-height: inherit;
}

hr {
  height: 0;
  color: inherit;
  border-top-width: 1px;
}

abbr[title] {
  -webkit-text-decoration: underline dotted;
  text-decoration: underline dotted;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-size: inherit;
  font-weight: inherit;
}

a {
  color: inherit;
  text-decoration: inherit;
}

b,
strong {
  font-weight: bolder;
}

code,
kbd,
samp,
pre {
  font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, Liberation Mono, Courier New, monospace;
  font-size: 1em;
}

small {
  font-size: 80%;
}

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

table {
  text-indent: 0;
  border-color: inherit;
  border-collapse: collapse;
}

button,
input,
optgroup,
select,
textarea {
  font-family: inherit;
  font-feature-settings: inherit;
  font-variation-settings: inherit;
  font-size: 100%;
  font-weight: inherit;
  line-height: inherit;
  color: inherit;
  margin: 0;
  padding: 0;
}

button,
select {
  text-transform: none;
}

button,
[type="button"],
[type="reset"],
[type="submit"] {
  -webkit-appearance: button;
  background-color: transparent;
  background-image: none;
}

:-moz-focusring {
  outline: auto;
}

:-moz-ui-invalid {
  box-shadow: none;
}

progress {
  vertical-align: baseline;
}

::-webkit-inner-spin-button,
::-webkit-outer-spin-button {
  height: auto;
}

[type="search"] {
  -webkit-appearance: textfield;
  outline-offset: -2px;
}

::-webkit-search-decoration {
  -webkit-appearance: none;
}

::-webkit-file-upload-button {
  -webkit-appearance: button;
  font: inherit;
}

summary {
  display: list-item;
}

blockquote,
dl,
dd,
h1,
h2,
h3,
h4,
h5,
h6,
hr,
figure,
p,
pre {
  margin: 0;
}

fieldset {
  margin: 0;
  padding: 0;
}

legend {
  padding: 0;
}

ol,
ul,
menu {
  list-style: none;
  margin: 0;
  padding: 0;
}

dialog {
  padding: 0;
}

textarea {
  resize: vertical;
}

input::-moz-placeholder,
textarea::-moz-placeholder {
  opacity: 1;
  color: #9ca3af;
}

input::placeholder,
textarea::placeholder {
  opacity: 1;
  color: #9ca3af;
}

button,
[role="button"] {
  cursor: pointer;
}

:disabled {
  cursor: default;
}

img,
svg,
video,
canvas,
audio,
iframe,
embed,
object {
  display: block;
  vertical-align: middle;
}

img,
video {
  max-width: 100%;
  height: auto;
}

[hidden] {
  display: none;
}

.absolute {
  position: absolute;
}

.right-0 {
  right: 0;
}

.m-10 {
  margin: 2.5rem;
}

.m-[-8px] {
  margin: -8px;
}

.mx-4 {
  margin-left: 1rem;
  margin-right: 1rem;
}

.mx-7 {
  margin-left: 1.75rem;
  margin-right: 1.75rem;
}

.mb-12 {
  margin-bottom: 3rem;
}

.mr-12 {
  margin-right: 3rem;
}

.mr-40 {
  margin-right: 10rem;
}

.mr-7 {
  margin-right: 1.75rem;
}

.mr-[137px] {
  margin-right: 137px;
}

.mr-[35px] {
  margin-right: 35px;
}

.mr-[68px] {
  margin-right: 68px;
}

.mt-1 {
  margin-top: 0.25rem;
}

.mt-12 {
  margin-top: 3rem;
}

.mt-3 {
  margin-top: 0.75rem;
}

.mt-4 {
  margin-top: 1rem;
}

.mt-6 {
  margin-top: 1.5rem;
}

.mt-8 {
  margin-top: 2rem;
}

.mt-[160px] {
  margin-top: 160px;
}

.flex {
  display: flex;
}

.h-[120px] {
  height: 120px;
}

.h-[160px] {
  height: 160px;
}

.max-w-[210mm] {
  max-width: 210mm;
}

.items-center {
  align-items: center;
}

.justify-center {
  justify-content: center;
}

.border-2 {
  border-width: 2px;
}

.border-black {
  border-color: rgba(0, 0, 0, 1);
}

.p-0 {
  padding: 0;
}

.text-center {
  text-align: center;
}

.text-right {
  text-align: right;
}

.text-2xl {
  font-size: 1.5rem;
  line-height: 2rem;
}

.text-[13px] {
  font-size: 13px;
}

.text-lg {
  font-size: 1.125rem;
  line-height: 1.75rem;
}

.text-xl {
  font-size: 1.25rem;
  line-height: 1.75rem;
}

.font-bold {
  font-weight: 700;
}

.font-medium {
  font-weight: 500;
}

.font-semibold {
  font-weight: 600;
}

.underline {
  text-decoration-line: underline;
}

.decoration-blue-600 {
  text-decoration-color: #2563eb;
}

.decoration-2 {
  text-decoration-thickness: 2px;
}
    </style>
</head>

<body>
    <div class="m-10 max-w-[210mm] text-lg">
        <div class="items-center justify-center mt-4">
            <div class="mr-7">
                <img src="{{ public_path('sense/media/logos/logo-comtel.png') }}" class="h-[120px]">
            </div>
            <div class="mx-4 text-center">
                <div class="font-medium">
                    <p class="font-bold text-xl p-0 m-[-8px]">PT. COMTELINDO</p>
                    <p class="p-0 m-[-8px]">Jl. Let Kol. Pol. HM. Asnawi Arbain RT.30 No.161 Kelurahan Sungai</p>
                    <p class="p-0 m-[-8px]">Nangka Kecamatan Balikpapan Selatan 76114, Telepon: 0542 8706777</p>
                    <p class="p-0 m-[-8px]">Website : <a class="underline decoration-blue-600" href="www.comtelindo.com">www.comtelindo.com</a></p>
                    <p class="p-0 m-[-8px]">Email : <a class="underline decoration-blue-600" href="mailto: info@comtelindo.com">info@comtelindo.com</a></p>
                </div>
            </div>
        </div>

        <hr class="border-1 border-black mt-1">
        <hr class="border-2 border-black mt-1">

        <div class="mt-3 mb-12">
            <div class="text-center">
                <p class="underline decoration-2 font-semibold text-2xl">SURAT TUGAS</p>
                <p>Nomor 088/CMT-WO/OPS/VIII/2023</p>
            </div>

            <div class="mt-4">
                <div>
                    <span class="mr-40">Perihal</span>
                    : Surat Tugas Perjalanan Dinas
                </div>
                <div>
                    <span class="mr-7">Durasi Perjalanan Dinas</span>
                    : 5 (lima) Hari
                </div>
                <div>
                    <span class="mr-[137px]">Lokasi PD</span>
                    : Buntok Kalimantan Tengah
                </div>
            </div>

            <div class="mt-6">
                <p>Yang bertanda tangan dibawah ini :</p>
                <div>
                    <span class="mr-12">Nama</span>
                    : Bambang Widya D
                </div>
                <div>
                    <span class="mr-[35px]">Jabatan</span>
                    : Operation ISP & Telco Manager
                </div>
                <div>
                    <span class="mr-[68px]">NIK</span>
                    : 78210130
                </div>
            </div>

            <div class="mt-8">
                <p>Bersamaan dengan ini, kami memberikan Tugas Dinas kepada :</p>
                <div>
                    <span class="mr-12">Nama</span>
                    : Ahmad Maulana
                </div>
                <div>
                    <span class="mr-[35px]">Jabatan</span>
                    : IoT Engineer
                </div>
                <div>
                    <span class="mr-[68px]">NIK</span>
                    : 99220134
                </div>
            </div>

            <div class="mt-6">
                <p>
                    untuk Maintenance Perangkat ATG PT.IBS di Area Site PT.MUTU dengan durasi kerja
                    <span class="font-bold">19 Agustus s.d 23 Agustus 2023</span>
                </p>
            </div>

            <div class="mt-6">
                <p>Demikian surat Perintah Kerja ini kami sampaikan, atas perhatian dan kerja samanya kami ucapkan
                    terima kasih.</p>
            </div>

            <div class="mt-12">
                <div class="text-right">
                    <p>Balikpapan,18 Agustus 2023</p>
                    <p>PT. COMTELINDO</p>
                    <img class="h-[160px] absolute right-0" src="{{ public_path('sense/media/sign_pegawai/1DWvxMPiicE5VFWY8nlzKyvTguVS18qTtXvWf3Mg.png') }}" alt="ttd">
                    <p class="mt-[160px]">BAMBANG WIDYA. D</p>
                    <p class="font-bold">MANAGER OPERATION</p>
                </div>
            </div>
        </div>

        <hr class="border-2 border-black mt-1">
        <hr class="border-1 border-black mt-1">

        <p class="text-[13px] mx-7 mt-1">Dedicated Internet | Broadband Internet | Connectivity Services | Voice Services | IT Solutions | VoIP | Call Center | GPS Tracking</p>

    </div>
</body>

</html>
