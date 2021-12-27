<div>
    <div class="row">
        <style>
            #FormTim {
                display: none;
            }

            #FormIndividu {
                display: none;
            }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script>
            $(document).ready(function() {

                $('input[type="radio"]').click(function() {
                    //  $('.js-example-basic-multiple').select2();
                    var demovalue = $(this).val();
                    $(".myDiv").hide();
                    $("#Form" + demovalue).show();
                });
            });
        </script>
        <div class="col-xl col-lg">
            <form wire:submit.prevent="storePpengajaran" action="">

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="pb-2">


                            <div class="form-group">
                                <label for="exampleInputEmail1">Tahun Ajaran</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <select class="form-control" wire:model="tahun_ajaran" id="sel1">
                                    <option value=""></option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Semester Tahun Ajaran</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <div>
                                    <input class="mr-1" type="radio" wire:change="change" name="sms" wire:model="sms" id="" value="2"><label class="mr-3" for="">Genap</label>
                                    <input class="mr-1" type="radio" wire:change="change" name="sms" wire:model="sms" id="" value="1"><label for="">Ganjil</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">MATA KULIAH</label><br>
                                <small> Keterangan : [KODE MATKUL] - NAMA MATKUL - SKS</small>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <select class="form-control" wire:model="matkul" name="matkul" id="sel1">
                                    <option value=""></option>
                                    @forelse($data_matkul as $item)
                                    <option value="{{ $item->kode_mk }}">({{ $item->kode_mk }}), {{ $item->nama_mk }} - {{ $item->jml_sks }}</option>
                                    @empty
                                    <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Banyak Mahasiswa</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <div>
                                    <label for="">{{ $mahasiswa }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">SKS Mata Kuliah</label>
                                <input type="number" class="form-control" wire:model="sks" name="sks" readonly required>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rasio</label>
                                {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                                <select class="form-control" wire:model="rasio" id="sel1">
                                    <option value=""></option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">JUM. KELAS</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelas" name="jumkelas" required>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">JUM. KELAS PENYESUAIAN</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" wire:model="jumkelasp" name="jumkelasp" required>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">SKS Penyesuaian (Hasil Kali Antara Jum.Kelas Penyesuaian dengan SKS Mata Kuliah)</label>
                                <input readonly type="text" class="form-control" id="exampleInputEmail1" wire:model="sks_penyesuaian" required>

                            </div>
                            {{-- <div class="form-group">
                            <label for="exampleInputEmail1">NAMA DOSEN</label>
                            
                            <select class="theSelect form-control" wire:model="dosen" required>
                                <option value=""></option>
                                @foreach ($listDosen as $data)
                                    <option value="{{$data->no_registrasi}}">{{$data->nama}}</option>
                            @endforeach
                            </select>

                        </div> --}}

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tipe Mengajar</label>
                            <div class="form-check">
                                <input value="Individu" type="radio" wire:model="tipe_mengajar" value="Tim">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Individu
                                </label>
                            </div>
                            <div class="form-check">
                                <input value="Tim" type="radio" wire:model="tipe_mengajar" value="Individu">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Tim
                                </label>
                            </div>
                        </div>

                        <div class="myDiv" id="FormTim">
                            <span>FORM TIM</span>
                        </div>

                        <div class="myDiv" id="FormIndividu">
                            <span>FORM INDIVIDU</span>
                        </div>



                        <div class="form-group">
                            <label for="exampleInputEmail1">Pilih Nama Dosen (Sebagai Individu atau Sebagai Tim)</label> <br>
                            <label for="exampleInputEmail1" style="color: red; font-weight:bold;">Jika Sebagai Tim, Pilih Nama Dosen Koordinator</label>

                            <x-lwa::autocomplete class="form-control" name="user-name" wire:model-text="namaDosen" wire:model-id="idDosen" wire:model-results="listDosen" :options="[
                            'text'=> 'nama',
                            'id' => 'no_registrasi',
                            'allow-new'=> 'false',
                        ]" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No induk</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <div>
                                <label for="">{{ $this->no_induk }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Jabatan Fungsional</label>
                            {{-- <input type="text" class="form-control" id="exampleInputEmail1" name="matkul" required> --}}
                            <div>
                                <label for="">{{ $this->bio_dosen }}</label>
                            </div>
                        </div>



                        <button type="submit" class="btn btn-primary">Save Data</button> <button type="submit" wire:submit.prevent="clearForm" class="btn btn-primary">Clear</button>
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">JENIS KEGIATAN / MATA KULIAH</label>
                            <select class="form-control" name="matkul" id="sel1" required>
                                @forelse($matkul as $item)
                                <option value="{{ $item->nama_mk }}">{{ $item->nama_mk }}</option>
                        @empty
                        <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                        @endforelse
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                            <label for="exampleInputEmail1">BUKTI PENUGASAN</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="buktipenugasan" required>
                        </div> --}}
                    {{-- <div class="form-group">
                            <label for="exampleInputEmail1">JUM.SKS</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="jumsks" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">MASA PENUGASAN (BULAN)</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" name="masapenugasan" required>
                        </div> --}}
                </div>
        </div>
    </div>
    </form>
</div>


</div>
</div>