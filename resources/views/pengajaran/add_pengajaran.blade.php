<x-app-layout>
    @livewireStyles

    <div class="mb-4 d-sm-flex align-items-center justify-content-between">
        <h1 class="mb-0 text-gray-800 h3">Lengkapi Data Pribadi</h1>
    </div>

    <div class="row">

        <div class="col-xl-4 col-lg-5">
            <div class="mb-4 shadow card">
                <div class="card-body">
                    <div class="pb-2">
                        <x-pengajaran.form-group-options />
                        <x-pengajaran.form-group />
                        <x-pengajaran.form-group />
                        <x-pengajaran.form-group />
                    </div>
                </div>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @livewire('users', ['dosen' => $dosen])

    </div>

    @livewireScripts
</x-app-layout>

<!-- Page Heading -->
