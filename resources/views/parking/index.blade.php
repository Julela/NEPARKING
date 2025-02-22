@extends('templates.app')

@section('container')
<div class="card-secton transfer-section"> 
    <div class="tf-container">
        <div class="tf-balance-box">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-lg font-semibold mb-4">🅿 Pilih Tempat Parkir</h2>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- Grid Slot Parkir -->
<div class="parking-lot">
    @foreach($slots as $slot)
        <form method="POST" action="{{ $slot->is_booked && $slot->user_id == auth()->id() ? route('parkir.cancel') : route('parkir.book') }}">
            @csrf
            <input type="hidden" name="slot_number" value="{{ $slot->slot_number }}">
            <button type="submit" 
                class="slot {{ $slot->is_booked ? ($slot->user_id == auth()->id() ? 'booked-by-user' : 'booked') : 'available' }}">
                {{ $slot->slot_number }}
            </button>
        </form>
    @endforeach
</div>

<style>
    /* Grid Responsif */
    .parking-lot {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        justify-content: center;
        padding: 20px;
        max-width: 500px;
        margin: auto;
    }

    /* Tombol Slot Parkir */
    .slot {
        width: 100%;
        max-width: 70px;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid black;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    /* Warna Slot */
    .available {
        background-color: green;
        color: white;
    }

    .booked {
        background-color: red;
        color: white;
        pointer-events: none; /* Tidak bisa diklik jika sudah dipesan oleh user lain */
    }

    .booked-by-user {
        background-color: orange;
        color: white;
    }

    /* Media Queries untuk responsif */
    @media (max-width: 600px) {
        .parking-lot {
            max-width: 50px;
            font-size: 0.75rem;
        }
    }
</style>

<!-- <style>
    

    .parking-lot {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        /* 5 slot per baris */
        gap: 6px;
    }

    .slot {
        width: 100%;
        max-width: 70px;
        aspect-ratio: 1/1;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid black;
        font-size: 0.875rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .available {
        background-color: #86efac;
        /* Hijau muda */
    }

    .occupied {
        background-color: red !important;
        pointer-events: none;
    }

    @media (max-width: 600px) {
        .parking-lot {
            max-width: 50px;
            font-size: 0.75rem;
        }
    }
    
</style>  -->


    <!-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="parking-lot" id="parkingLot">
        @foreach($slots as $slot)
            <form method="POST" action="{{ $slot->is_booked ? route('parkir.cancel') : route('parkir.book') }}">
                @csrf
                <input type="hidden" name="slot_number" value="{{ $slot->slot_number }}">
                <button type="submit" class="slot {{ $slot->is_booked ? 'booked' : '' }}">
                    {{ $slot->slot_number }}
                </button>
            </form>
        @endforeach
    </div> 


 <style>
    .parking-lot {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        max-width: 400px;
        margin: auto;
    }
    .slot {
        width: 60px;
        height: 60px;
        background-color: green;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        cursor: pointer;
        color: white;
        font-size: 18px;
        font-weight: bold;
        transition: 0.3s;
        border: none;
    }
    .booked {
        background-color: red !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".slot").forEach(button => {
            button.addEventListener("click", function (e) {
                e.preventDefault();

                let selected = document.querySelector(".slot.selected");
                if (selected && selected !== this) {
                    alert("Anda hanya bisa memilih satu slot parkir!");
                } else {
                    this.closest("form").submit();
                }
            });
        });
    });
</script> -->



<!-- <div class="parking-container flex flex-col items-center justify-center min-h-screen p-4">
    <div class="parking-grid grid grid-cols-5 gap-2 w-full max-w-md">
        @foreach($slots as $slot)
        <div class="parking-slot flex items-center justify-center border-2 border-black cursor-pointer 
                    {{ $slot->is_booked == 'occupied' ? 'bg-red-500 text-white occupied' : 'bg-green-300 available' }}"
            data-slot="{{ $slot->slot_number }}">
            {{ $slot->slot_number }}
        </div>
        @endforeach
    </div>
</div>

<script>
    let selectedSlot = null; // Menyimpan slot yang dipilih

    document.querySelectorAll('.parking-slot').forEach(slot => {
        slot.addEventListener('click', function () {
            let slotNumber = this.getAttribute('data-slot');

            if (this.classList.contains('occupied')) {
                // Jika slot merah (dipilih), klik lagi untuk membatalkan
                let confirmCancel = confirm(`Yakin mau membatalkan pilihan slot ${slotNumber}?`);
                if (!confirmCancel) return;

                this.classList.remove('bg-red-500', 'text-white', 'occupied');
                this.classList.add('bg-green-300', 'available');

                selectedSlot = null; // Reset pilihan slot

                fetch("{{ route('parkir.cancel') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ slot_number: slotNumber })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert("Gagal membatalkan pemilihan!");
                        this.classList.remove('bg-green-300', 'available');
                        this.classList.add('bg-red-500', 'text-white', 'occupied');
                        selectedSlot = this; // Kembalikan slot sebagai pilihan aktif
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan jaringan, coba lagi!");
                    this.classList.remove('bg-green-300', 'available');
                    this.classList.add('bg-red-500', 'text-white', 'occupied');
                    selectedSlot = this;
                });

            } else if (this.classList.contains('available')) {
                // Jika slot hijau, pilih sebagai tempat parkir
                let confirmBooking = confirm(`Yakin mau memilih slot ${slotNumber}?`);
                if (!confirmBooking) return;

                // Jika sebelumnya sudah ada slot yang dipilih, kembalikan ke hijau
                if (selectedSlot) {
                    selectedSlot.classList.remove('bg-red-500', 'text-white', 'occupied');
                    selectedSlot.classList.add('bg-green-300', 'available');
                }

                // Tandai slot baru sebagai yang dipilih
                this.classList.remove('bg-green-300', 'available');
                this.classList.add('bg-red-500', 'text-white', 'occupied');
                selectedSlot = this;

                fetch("{{ route('parkir.book') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ slot_number: slotNumber })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        alert("Slot sudah terisi!");
                        this.classList.remove('bg-red-500', 'text-white', 'occupied');
                        this.classList.add('bg-green-300', 'available');
                        selectedSlot = null;
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Terjadi kesalahan jaringan, coba lagi!");
                    this.classList.remove('bg-red-500', 'text-white', 'occupied');
                    this.classList.add('bg-green-300', 'available');
                    selectedSlot = null;
                });
            }
        });
    });
</script>
-->


@endsection