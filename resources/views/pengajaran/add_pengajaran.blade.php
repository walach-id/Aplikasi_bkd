 <x-app-layout>
     <!-- Page Heading -->
     <div class="d-sm-flex align-items-center justify-content-between mb-4">
         <h1 class="h3 mb-0 text-gray-800">Lengkapi Data Berikut</h1>
     </div>
     <form action="{{ url('/bkd') }}" method="post">
         @csrf
         <div class="row">
             <div class="col-xl-4 col-lg-5">
                 <div class="card shadow mb-4">
                     <div class="card-body">
                         <div class="pb-2">
                             <div class="form-group">
                                 <label for="exampleInputEmail1">JENIS KEGIATAN / MATA KULIAH</label>
                                 <select class="form-control" name="matkul" id="sel1" required>
                                     @forelse($matkul as $item)
                                     <option value="{{ $item->kode_mk }}">{{ $item->nama_mk }}</option>
                                     @empty
                                     <option disabled> DATA MATA KULIAH TIDAK DI TEMUKAN</option>
                                     @endforelse
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">BUKTI PENUGASAN</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="buktipenugasan" required>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">JUM.SKS</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="jumsks" required>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">MASA PENUGASAN (BULAN)</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="masapenugasan" required>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-xl-4 col-lg-5">
                 <div class="card shadow mb-4">
                     <div class="card-body">
                         <div class="pb-2">
                             <div class="form-group">
                                 <label for="exampleInputEmail1">BUKTI DOKUMEN</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="buktidokumen" required>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">JUM.PERTEMUAN</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="jumpertemuan" required>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">NAMA DOSEN YANG DISERAHKAN TUGAS </label>
                                 <br>
                                 <select multiple class="form-control" name="dosen" id="dosen">
                                     @forelse($dosen as $item)
                                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                                     @empty
                                     <option disabled> DATA DOSEN TIDAK DI TEMUKAN</option>
                                     @endforelse
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">JUMLAH PENYERAHAN TUGAS</label>
                                 <input type="text" class="form-control" id="exampleInputEmail1" name="jumtugas" required">
                             </div>
                             <button type="submit" class="btn btn-primary">Save BKD</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </form>
 </x-app-layout>