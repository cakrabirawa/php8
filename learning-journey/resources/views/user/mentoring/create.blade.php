<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Add Mentoring</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        <form method="POST" action="{{ route('user.mentoring.store') }}"
              class="bg-white shadow rounded p-6 space-y-4">
            @csrf

            <div> 
                <label class="font-semibold">Employee</label>
                <select name="employee_id" class="w-full border rounded px-3 py-2">
                    @foreach ($employees as $e)
                        <option value="{{ $e->employee_id }}">{{ $e->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold">Mentor Name</label>
                <input type="text" name="mentor_name"
                       class="w-full border rounded px-3 py-2" required>
            </div>

            <div>
                <label class="font-semibold">Notes</label>
                <textarea name="notes" class="w-full border rounded px-3 py-2" required></textarea>
            </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Mentoring Score: 
                <span id="mentoringScoreVal" class="text-indigo-600">50</span>
            </label>

            <input type="range"
                name="score"
                min="1"
                max="100"
                value="{{ old('score', 50) }}"
                id="mentoringSlider"
                oninput="updateMentoringSlider(this)"
                class="w-full h-2 rounded-lg appearance-none cursor-pointer bg-gray-200 shadow-sm">

            <div class="flex justify-between text-xs text-gray-500 mt-1">
                <span>1</span>
                <span class="font-medium">Slide to rate</span>
                <span>100</span>
            </div>
        </div>

            <button class="bg-green-600 text-white px-4 py-2 rounded">
                Save
            </button>
        </form>
    </div>

<script>
function updateMentoringSlider(slider) {
    const value = parseInt(slider.value);
    const min = slider.min;
    const max = slider.max;
    const percentage = ((value - min) / (max - min)) * 100;

    // Update tampilan angka
    const scoreValSpan = document.getElementById('mentoringScoreVal');
    scoreValSpan.innerText = value;

    // Logika Warna (Tailwind Colors: Red 500, Yellow 400, Green 500)
    let color = '#ef4444'; // Default Merah (< 50)

    if (value >= 75) {
        color = '#22c55e'; // Hijau
        scoreValSpan.style.color = '#22c55e';
    } else if (value >= 50) {
        color = '#facc15'; // Kuning
        scoreValSpan.style.color = '#ca8a04'; // Darker yellow for text visibility
    } else {
        scoreValSpan.style.color = '#ef4444';
    }

    // Terapkan background gradient pada track slider
    slider.style.background = `linear-gradient(to right, 
        ${color} 0%, 
        ${color} ${percentage}%, 
        #e5e7eb ${percentage}%, 
        #e5e7eb 100%)`;
}

// Jalankan saat halaman pertama kali dimuat (Inisialisasi)
document.addEventListener("DOMContentLoaded", function () {
    const mSlider = document.getElementById('mentoringSlider');
    if(mSlider) {
        updateMentoringSlider(mSlider);
    }
});
</script>
</x-app-layout>
