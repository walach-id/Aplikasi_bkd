 <x-app-layout>
     <!-- Page Heading -->
     <div class="mb-4 d-sm-flex align-items-center justify-content-between">
         <h1 class="mb-0 text-gray-800 h3">Ubah data di bawah ini</h1>
         <!-- <a href="#" class="shadow-sm d-none d-sm-inline-block btn btn-sm btn-primary"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    -->
     </div>
     <div class="row">
         <div class="col-xl-4 col-lg-5">
             <div class="mb-4 shadow card">
                 <!-- Card Header - Dropdown -->
                 <div class="flex-row py-3 card-header d-flex align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Kependudukan</h6>
                 </div>
                 <!-- Card Body -->
                 <form action="{{ url('update/profil') }}" method="POST">
                     @csrf
                     @foreach ($profil as $item)
                         <div class="card-body">
                             <div class="pb-2">
                                 <div class="form-group">
                                     @if ($item->nidn)
                                         <h1>NIDN</h1>
                                         <?php
                                         $seleksi_nidn = 'selected';
                                         $seleksi_nidk = '';
                                         $seleksi_nup = '';
                                         ?>
                                     @elseif($item->nidk)
                                         <h1>NIDK</h1>
                                         <?php
                                         $seleksi_nidn = '';
                                         $seleksi_nidk = 'selected';
                                         $seleksi_nup = '';
                                         ?>
                                     @elseif($item->nup)
                                         <h1>NUP</h1>
                                         <?php
                                         $seleksi_nidn = '';
                                         $seleksi_nidk = '';
                                         $seleksi_nup = 'selected';
                                         ?>
                                     @endif
                                     <label for="exampleInputEmail1">Pilih salah satu</label>
                                     <select class="form-control" name="jenispengenal" id="sel1" required>
                                         <option value="NIDN" <?php echo $seleksi_nidn; ?>>NIDN</option>
                                         <option value="NIDK" <?php echo $seleksi_nidk; ?>>NIDK</option>
                                         <option value="NUP" <?php echo $seleksi_nup; ?>>NUP</option>
                                     </select>
                                 </div>
                                 @if ($item->nidn)
                                     <input value="{{ $item->nidn }}" type="text" class="form-control"
                                         id="exampleInputEmail1" name="idpengenal"
                                         placeholder="Ketik ID (Sesuai Pilihan di atas) Disini" required>
                                 @elseif($item->nidk)
                                     <input value="{{ $item->nidk }}" type="text" class="form-control"
                                         id="exampleInputEmail1" name="idpengenal"
                                         placeholder="Ketik ID (Sesuai Pilihan di atas) Disini" required>
                                 @elseif($item->nup)
                                     <input value="{{ $item->nup }}" type="text" class="form-control"
                                         id="exampleInputEmail1" name="idpengenal"
                                         placeholder="Ketik ID (Sesuai Pilihan di atas) Disini" required>
                                 @endif
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">NAMA</label>
                                 <input value="{{ $item->nama }}" type="text" class="form-control"
                                     id="exampleInputEmail1" name="nama" placeholder="Nama Lengkap Tanpa Gelar"
                                     required>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">JENIS KELAMIN</label>
                                 <select class="form-control" name="jenkel" id="sel1" required>
                                     <option {{ $item->jenkel == 'Laki-laki' ? 'selected' : '' }} value="Laki-Laki">
                                         Laki-Laki</option>
                                     <option {{ $item->jenkel == 'Perempuan' ? 'selected' : '' }} value="Perempuan">
                                         Perempuan</option>
                                 </select>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">TEMPAT LAHIR</label>
                                 <input value="{{ $item->tempat_lahir }}" type="text" class="form-control"
                                     id="exampleInputEmail1" name="tempatlahir" required>
                             </div>
                             <div class="form-group">
                                 <label for="exampleInputEmail1">TANGGAL LAHIR</label>
                                 <input value="{{ $item->tanggal_lahir }}" type="date" class="form-control"
                                     id="exampleInputEmail1" name="tanggallahir" required>
                             </div>
                             <button type="submit" class="btn btn-primary">Update Data</button>
                         </div>
                     @endforeach
                 </form>
             </div>
         </div>
     </div>
 </x-app-layout>
