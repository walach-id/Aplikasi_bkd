    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex-row d-flex">
        <div class="mb-4 shadow card">
            <div class="card-body">
                <div class="pb-2">

                    <div class="form-group">
                        <label for="exampleInputEmail1">BUKTI DOKUMEN</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">JUM.PERTEMUAN</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">NAMA DOSEN 1</label>
                        <br>
                        <datalist id="dosen">
                            @forelse($dosen as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @empty
                                <option disabled> DATA DOSEN TIDAK DI TEMUKAN</option>
                            @endforelse
                        </datalist>
                        <input type="text" list="dosen" style="width:330px;" />
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">JUMLAH PENYERAHAN TUGAS</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="tempatlahir" required>
                    </div>

                    <button class="text-white btn btn-info btn-sm"
                        wire:click.prevent="add({{ $i }})">Add</button>
                    <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Save</button>

                </div>
            </div>
        </div>

        @foreach ($inputs as $key => $value)
            <div class="mb-4 shadow card">
                <div class="card-body">
                    <div class="pb-2">

                        <div class="form-group">
                            <label for="exampleInputEmail1">NAMA DOSEN {{ $value }}</label>
                            <br>
                            <input type="text" list="dosen" style="width:330px;" />
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail {{ $value }}">JUMLAH PENYERAHAN TUGAS</label>
                            <input type="text" class="form-control" id=" exampleInputEmail {{ $value }}"
                                name=" tempatlahir {{ $value }}" required>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
