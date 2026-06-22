<x-layout>
    <x-slot:title>Support Ticket Reply - TailAdmin</x-slot:title>

    <!-- Page Title & Breadcrumbs -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
        <h2 class="text-2xl font-bold text-slate-800">Support Ticket reply</h2>
        <div class="text-sm text-gray-500 flex items-center gap-2">
            <a href="#" class="hover:text-blue-600">Home</a> 
            <span>&gt;</span> 
            <span class="text-slate-800">Support Ticket reply</span>
        </div>
    </div>

    <!-- 2-Column Responsive Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        
        <!-- KOLOM KIRI: Chat & Messages Threads -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 space-y-6">
                
                <!-- Ticket Info Header -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-b border-slate-100 pb-4 gap-2">
                    <div>
                        <h3 class="font-bold text-lg text-slate-800">Ticket #346520 - Sidebar not responsive on mobile</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Mon, 3:20 PM (2 days ago)</p>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-500 self-end sm:self-auto">
                        <span>4 of 120</span>
                        <div class="flex border border-slate-200 rounded">
                            <button class="px-2.5 py-1 border-r border-slate-200 hover:bg-slate-50"><i class="fa-solid fa-chevron-left text-xs"></i></button>
                            <button class="px-2.5 py-1 hover:bg-slate-50"><i class="fa-solid fa-chevron-right text-xs"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Message Item 1 (Customer) -->
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <img src="https://unsplash.com" class="w-10 h-10 rounded-full object-cover">
                            <div>
                                <h4 class="font-semibold text-sm">John Doe</h4>
                                <p class="text-xs text-gray-400">johndoe@gmail.com</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-400 hidden sm:inline">Mon, 3:20 PM (2 hrs ago)</span>
                    </div>
                    <div class="text-sm text-slate-600 leading-relaxed pl-13 space-y-2">
                        <p>Hi TailAdmin Team,</p>
                        <p>I hope you're doing well.</p>
                        <p>I'm currently working on customizing the TailAdmin dashboard and would like to add a new section labeled "Reports". Before I proceed, I wanted to check if there's any official guide or best practice you recommend.</p>
                    </div>
                </div>

                <!-- Reply Box Input Field -->
                <div class="border border-slate-200 rounded-lg p-4 bg-slate-50 mt-4">
                    <textarea rows="4" placeholder="Type your reply here..." class="w-full bg-transparent border-none text-sm outline-none resize-none text-slate-700 placeholder-slate-400"></textarea>
                    <div class="flex items-center justify-between border-t border-slate-200 pt-3 mt-2">
                        <button class="flex items-center gap-2 text-slate-500 hover:text-slate-700 text-sm font-medium">
                            <i class="fa-solid fa-paperclip"></i> Attach
                        </button>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm px-5 py-2 rounded-md transition shadow-xs">
                            Reply
                        </button>
                    </div>
                </div>

            </div>
        </div>

        <!-- KOLOM KANAN: Ticket Details Information Card -->
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 space-y-5">
            <h4 class="font-bold text-slate-800 border-b border-slate-100 pb-3 text-base">Ticket Details</h4>
            <div class="space-y-4 text-sm">
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 font-medium">Customer</span>
                    <span class="col-span-2 text-slate-700 font-medium">: John Doe</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 font-medium">Email</span>
                    <span class="col-span-2 text-slate-700 break-all">: jhonndoe@gmail.com</span>
                </div>
                <div class="grid grid-cols-3 gap-2">
                    <span class="text-gray-400 font-medium">Ticket ID</span>
                    <span class="col-span-2 text-slate-700 font-mono">: #346520</span>
                </div>
            </div>
        </div>

    </div>
</x-layout>
