@extends('layouts.admin')

@section('title', 'Redeem Code')
@section('page_title', 'Redeem Code')

@section('content')
    @php
        $bulanIndonesia = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        ];
        $formatTanggal = static function (\DateTimeInterface $tanggal) use ($bulanIndonesia): string {
            return $tanggal->format('d').' '.$bulanIndonesia[(int) $tanggal->format('n')].' '.$tanggal->format('Y');
        };
        $contohKode = [
            [
                'kode' => 'REFILL-APEL-2024',
                'poin' => 5,
                'created_at' => Illuminate\Support\Carbon::parse('2024-10-25'),
                'berlaku_mulai' => Illuminate\Support\Carbon::parse('2024-11-01'),
                'berlaku_hingga' => Illuminate\Support\Carbon::parse('2024-11-30'),
                'status' => 'tersedia',
                'status_label' => 'Tersedia',
                'is_preview' => true,
            ],
            [
                'kode' => 'APEL-MALANG-GRATIS',
                'poin' => 5,
                'created_at' => Illuminate\Support\Carbon::parse('2024-10-12'),
                'berlaku_mulai' => Illuminate\Support\Carbon::parse('2024-10-15'),
                'berlaku_hingga' => Illuminate\Support\Carbon::parse('2024-11-05'),
                'nama_pengguna' => 'Dian Pratiwi',
                'dipakai_pada' => Illuminate\Support\Carbon::parse('2024-10-26 14:10'),
                'status' => 'terpakai',
                'status_label' => 'Terpakai',
                'is_preview' => true,
            ],
            [
                'kode' => 'HARVEST-REFILL-APEL',
                'poin' => 5,
                'created_at' => Illuminate\Support\Carbon::parse('2024-10-28'),
                'berlaku_mulai' => Illuminate\Support\Carbon::parse('2024-11-01'),
                'berlaku_hingga' => Illuminate\Support\Carbon::parse('2024-12-15'),
                'status' => 'tersedia',
                'status_label' => 'Tersedia',
                'is_preview' => true,
            ],
            [
                'kode' => 'BOTANICAL-APEL-GIFT',
                'poin' => 5,
                'created_at' => Illuminate\Support\Carbon::parse('2024-10-18'),
                'berlaku_mulai' => Illuminate\Support\Carbon::parse('2024-10-20'),
                'berlaku_hingga' => Illuminate\Support\Carbon::parse('2024-11-05'),
                'nama_pengguna' => 'Rian Kusuma',
                'dipakai_pada' => Illuminate\Support\Carbon::parse('2024-10-21 10:16'),
                'status' => 'terpakai',
                'status_label' => 'Terpakai',
                'is_preview' => true,
            ],
            [
                'kode' => 'LOYALTY-REFILL-APEL',
                'poin' => 5,
                'created_at' => Illuminate\Support\Carbon::parse('2024-08-06'),
                'berlaku_mulai' => Illuminate\Support\Carbon::parse('2024-08-10'),
                'berlaku_hingga' => Illuminate\Support\Carbon::parse('2024-08-20'),
                'status' => 'kadaluarsa',
                'status_label' => 'Kadaluarsa',
                'is_preview' => true,
            ],
            [
                'kode' => 'REFILL-APEL-PROMO',
                'poin' => 5,
                'created_at' => Illuminate\Support\Carbon::parse('2024-08-25'),
                'berlaku_mulai' => Illuminate\Support\Carbon::parse('2024-09-01'),
                'berlaku_hingga' => Illuminate\Support\Carbon::parse('2024-12-31'),
                'status' => 'tersedia',
                'status_label' => 'Tersedia',
                'is_preview' => true,
            ],
        ];
        $codesToDisplay = $totalKode === 0 ? collect($contohKode) : $redeemCodes;
    @endphp

    <div class="-mx-4 -my-6 min-h-[calc(100vh_-_4rem)] bg-[#f7f4e9] px-4 py-4 sm:-mx-6 sm:-my-9 sm:px-6 sm:py-5 lg:-mx-8 lg:px-8 xl:-mx-12 xl:px-12">
        <header class="mb-3 flex flex-wrap items-center justify-between gap-3">
            <div>
                <p class="text-[8px] font-semibold uppercase tracking-[0.16em] text-[#64835d]">Admin Ledger /</p>
                <h1 class="display-font mt-0.5 text-xl font-semibold text-[#183b2c] sm:text-2xl">Redeem Code Poin</h1>
                <p class="mt-1 text-[9px] text-[#718078]">
                    Khusus penukaran hadiah refill lilin aromaterapi aroma apel.
                </p>
            </div>
            <button type="button" onclick="openTambahModal()"
                class="inline-flex items-center gap-1.5 rounded-sm bg-[#103a2a] px-3 py-2 text-[8px] font-semibold uppercase tracking-wide text-white transition hover:bg-[#315d41]">
                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Buat Redeem Code
            </button>
        </header>

        <section class="overflow-hidden border border-[#e8dfd1] bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] table-fixed text-left">
                    <colgroup>
                        <col class="w-[18%]">
                        <col class="w-[8%]">
                        <col class="w-[10%]">
                        <col class="w-[16%]">
                        <col class="w-[12%]">
                        <col class="w-[10%]">
                        <col class="w-[14%]">
                        <col class="w-[12%]">
                    </colgroup>
                    <thead class="border-b border-[#e8dfd1] bg-[#eee9dc] text-[7px] uppercase tracking-[0.06em] text-[#655c54]">
                        <tr>
                            <th class="px-2 py-2 font-semibold">Kode Redeem</th>
                            <th class="px-2 py-2 font-semibold">Poin</th>
                            <th class="px-2 py-2 font-semibold">Tanggal Dibuat</th>
                            <th class="px-2 py-2 font-semibold">Masa Berlaku</th>
                            <th class="px-2 py-2 font-semibold">Pengguna</th>
                            <th class="px-2 py-2 font-semibold">Status</th>
                            <th class="px-2 py-2 font-semibold">Dipakai Pada</th>
                            <th class="px-2 py-2 text-center font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#eee8dc]">
                        @forelse ($codesToDisplay as $code)
                            @php
                                $isPreview = data_get($code, 'is_preview', false);
                                $kodeValue = data_get($code, 'kode');
                                $tanggalDibuat = data_get($code, 'created_at');
                                $berlakuMulai = data_get($code, 'berlaku_mulai');
                                $berlakuHingga = data_get($code, 'berlaku_hingga');
                                $dipakaiPada = data_get($code, 'dipakai_pada');
                                $status = data_get($code, 'status');
                                $isExpired = $isPreview
                                    ? $status === 'kadaluarsa'
                                    : ($status === 'tersedia' && $berlakuHingga && $berlakuHingga->isPast());
                                $statusLabel = $isExpired ? 'Kadaluarsa' : data_get($code, 'status_label');
                                $statusClass = match ($statusLabel) {
                                    'Terpakai' => 'bg-[#e6f0e2] text-[#45634d]',
                                    'Kadaluarsa' => 'bg-[#f1ece2] text-[#8b7261]',
                                    default => 'bg-[#e6f0e2] text-[#45634d]',
                                };
                                $namaPengguna = data_get($code, 'nama_pengguna') ?? data_get($code, 'user.nama_lengkap');
                            @endphp
                            <tr class="text-[8px] transition-colors hover:bg-[#fbf9f2] {{ $isExpired ? 'opacity-60' : '' }}">
                                <td class="px-2 py-2">
                                    <p class="break-words font-semibold leading-tight text-[#30483a] {{ $isExpired ? 'line-through' : '' }}">
                                        {{ $kodeValue }}
                                    </p>
                                </td>
                                <td class="px-2 py-2 whitespace-nowrap">
                                    <span class="font-semibold text-[#183b2c]">{{ number_format(data_get($code, 'poin')) }}</span>
                                    <span class="block text-[7px] text-[#718078]">Poin</span>
                                </td>
                                <td class="px-2 py-2 text-[#52645a]">
                                    {{ $formatTanggal($tanggalDibuat) }}
                                </td>
                                <td class="px-2 py-2 text-[#52645a]">
                                    @if ($berlakuMulai && $berlakuHingga)
                                        <p>{{ $formatTanggal($berlakuMulai) }}</p>
                                        <p class="text-[7px] text-[#87948b]">s/d {{ $formatTanggal($berlakuHingga) }}</p>
                                    @elseif ($berlakuHingga)
                                        <p class="text-[7px] text-[#87948b]">s/d</p>
                                        <p>{{ $formatTanggal($berlakuHingga) }}</p>
                                    @else
                                        <span class="text-[#45634d]">Selamanya</span>
                                    @endif
                                    @if ($isExpired)
                                        <p class="mt-0.5 text-[7px] font-semibold text-[#a9483b]">Kadaluarsa</p>
                                    @endif
                                </td>
                                <td class="px-2 py-2 text-[#30483a]">
                                    {{ $namaPengguna ?: '-' }}
                                </td>
                                <td class="px-2 py-2">
                                    <span class="inline-flex max-w-full rounded-sm px-1.5 py-1 text-[6px] font-semibold uppercase leading-tight {{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                </td>
                                <td class="px-2 py-2 text-[#52645a]">
                                    @if ($dipakaiPada)
                                        <p>{{ $formatTanggal($dipakaiPada) }}</p>
                                        <p class="text-[7px] text-[#87948b]">{{ $dipakaiPada->format('H:i') }} WIB</p>
                                    @else
                                        <span class="text-[#87948b]">-</span>
                                    @endif
                                </td>
                                <td class="px-2 py-2">
                                    <div class="flex justify-center">
                                        <button type="button" @disabled($isExpired)
                                            onclick="copyRedeemCode({{ Illuminate\Support\Js::from($kodeValue) }})"
                                            class="flex min-h-7 w-[52px] flex-col items-center justify-center gap-0.5 rounded-sm px-1 py-1 text-center text-[6px] font-bold uppercase leading-tight transition {{ $isExpired ? 'cursor-not-allowed bg-[#b7c8bc] text-white/80' : 'bg-[#103a2a] text-white hover:bg-[#315d41]' }}">
                                            <svg class="h-2.5 w-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h9a2 2 0 002-2v-2M8 5a2 2 0 002 2h3a2 2 0 002-2M8 5a2 2 0 012-2h3a2 2 0 012 2m0 4h3a2 2 0 012 2v5m-5-3 3 3m0 0 3-3m-3 3V9" />
                                            </svg>
                                            <span>Salin Kode</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-3 py-10 text-center">
                                    <p class="text-[10px] font-semibold text-[#30483a]">Tidak ada kode redeem yang cocok</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($redeemCodes->hasPages())
                <div class="flex items-center justify-between border-t border-[#e8dfd1] px-3 py-3">
                    <p class="text-[9px] text-[#718078]">
                        Menampilkan {{ $redeemCodes->firstItem() }}-{{ $redeemCodes->lastItem() }} dari
                        {{ $redeemCodes->total() }} kode
                    </p>
                    <div class="flex items-center gap-1">
                        {{ $redeemCodes->links() }}
                    </div>
                </div>
            @endif
        </section>
    </div>

    <!-- Modal Tambah Redeem Code -->
    <div id="redeem-modal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-[#0b251b]/60 p-4 backdrop-blur-sm">
        <div class="flex max-h-[90vh] min-h-[448px] w-full max-w-[468px] flex-col overflow-y-auto rounded-lg border border-[#d6d1c5] bg-[#fdfaf0] shadow-2xl">
            <div class="border-b border-[#315d41] bg-[#103a2a] px-4 py-3">
                <h2 class="display-font text-base font-normal text-[#fffdf7]">Tambah Kode Baru</h2>
            </div>

            <form id="redeem-form" action="{{ route('admin.kodeRedeem.store') }}" method="POST" class="flex min-h-[397px] flex-col gap-2 px-3 py-2">
                @csrf

                <!-- Pilihan Mode -->
                <div>
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-1">
                        <label class="flex cursor-pointer items-center gap-1.5">
                            <input type="radio" name="mode" value="manual" id="mode-manual"
                                class="h-3.5 w-3.5 accent-[#103a2a] focus:ring-[#103a2a]" checked
                                onchange="toggleMode()">
                            <span class="text-[7px] font-semibold uppercase text-[#263d32]">Ketik Manual (1 Kode)</span>
                        </label>
                        <label class="flex cursor-pointer items-center gap-1.5">
                            <input type="radio" name="mode" value="auto" id="mode-auto"
                                class="h-3.5 w-3.5 accent-[#103a2a] focus:ring-[#103a2a]"
                                onchange="toggleMode()">
                            <span class="text-[7px] font-semibold uppercase text-[#263d32]">Generate Otomatis (Banyak)</span>
                        </label>
                    </div>
                </div>

                <!-- Input Manual (Muncul jika mode = manual) -->
                <div id="input-manual">
                    <label class="mb-1 block text-[7px] font-semibold uppercase tracking-[0.06em] text-[#263d32]">Kode Redeem
                        <span class="text-[#b8292e]">*</span></label>
                    <input type="text" name="kode_manual"
                        class="w-full rounded-md border border-[#eee8dc] bg-white px-2.5 py-2 text-[9px] font-mono uppercase text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20"
                        placeholder="CONTOH: DISKON50K">
                </div>

                <!-- Input Auto Batch (Muncul jika mode = auto) -->
                <div id="input-auto" class="hidden">
                    <label class="mb-1 block text-[7px] font-semibold uppercase tracking-[0.06em] text-[#263d32]">Jumlah Kode
                        <span class="text-[#b8292e]">*</span></label>
                    <input type="number" name="jumlah" value="10" min="1" max="1000"
                        class="w-full rounded-md border border-[#eee8dc] bg-white px-2.5 py-2 text-[9px] text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                </div>

                <!-- Input Poin (Selalu Muncul) -->
                <div>
                    <label class="mb-1 block text-[7px] font-semibold uppercase tracking-[0.06em] text-[#263d32]">Nilai Poin
                        <span class="text-[#b8292e]">*</span></label>
                    <input type="number" name="poin" required min="1" value="5"
                        class="w-full rounded-md border border-[#eee8dc] bg-white px-2.5 py-2 text-[9px] text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                </div>

                <div>
                    <label class="mb-1 block text-[7px] font-semibold uppercase tracking-[0.06em] text-[#263d32]">Masa Aktif (Opsional)</label>
                    <input type="date" name="berlaku_hingga" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                        class="w-full rounded-md border border-[#eee8dc] bg-white px-2.5 py-2 text-[9px] text-[#30483a] outline-none focus:border-[#64835d] focus:ring-1 focus:ring-[#64835d]/20">
                </div>

                <div class="mt-1 flex justify-end gap-2 border-t border-[#e8dfd1] pt-2">
                    <button type="button" onclick="closeModal()"
                        class="min-w-[70px] rounded-md border border-[#d9d4c6] bg-[#fffdf7] px-3 py-1.5 text-[9px] font-semibold uppercase text-[#52645a] transition hover:bg-[#f5f0e2]">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex min-w-[180px] items-center justify-center gap-1.5 rounded-md bg-[#103a2a] px-3 py-1.5 text-[9px] font-semibold uppercase text-white transition hover:bg-[#315d41]">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" />
                        </svg>
                        Simpan Redeem Code
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk Toggle Mode -->
    <script>
        function openTambahModal() {
            document.getElementById('redeem-modal').classList.remove('hidden');
        }

        async function copyRedeemCode(kode) {
            try {
                await navigator.clipboard.writeText(kode);
                alert('Kode disalin!');
            } catch (error) {
                console.error(error);
                alert('Gagal menyalin kode.');
            }
        }

        function closeModal() {
            document.getElementById('redeem-modal').classList.add('hidden');
            document.getElementById('redeem-form').reset();
            toggleMode();
        }

        function toggleMode() {
            const isManual = document.getElementById('mode-manual').checked;
            const inputManual = document.getElementById('input-manual');
            const inputAuto = document.getElementById('input-auto');

            if (isManual) {
                inputManual.classList.remove('hidden');
                inputAuto.classList.add('hidden');
                // Hapus atribut required dari input auto agar tidak error validasi
                inputAuto.querySelector('input').removeAttribute('required');
                inputManual.querySelector('input').setAttribute('required', 'required');
            } else {
                inputManual.classList.add('hidden');
                inputAuto.classList.remove('hidden');
                // Hapus atribut required dari input manual
                inputManual.querySelector('input').removeAttribute('required');
                inputAuto.querySelector('input').setAttribute('required', 'required');
            }
        }

        // Close modal when clicking outside
        document.getElementById('redeem-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
@endsection
