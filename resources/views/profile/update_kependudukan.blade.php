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
                 <div class="card-body">
                     <div class="pb-2">
                         <form action="{{ url('update/kependudukan') }}" method="POST">
                             @csrf
                             @foreach ($profil as $item)
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">NIK</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" name="nik"
                                         value="{{ $item->nik }}" minlength="16" maxlength="16" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">NPWP</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1" name="npwp"
                                         value="{{ $item->npwp }}" minlength="15" maxlength="15" required>
                                 </div>
                                 <div class="form-group">
                                     <label for="exampleInputEmail1">Kewarganegaraan</label>
                                     <input type="text" class="form-control" id="exampleInputEmail1"
                                         name="warganegara" value="{{ $item->kewarganegaraan }}" minlength="4"
                                         required>
                                 </div>
                                 <button type="submit" class="btn btn-primary">Update Data</button>
                             @endforeach
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
