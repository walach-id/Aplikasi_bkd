<x-app-layout>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan Pengajaran Dosen</h1>
    </div>

    <!-- DataTales Example -->
    <div class="col-xl col-lg">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="pb-2">
                    <form action="{{ url('update/persetujuan') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <input hidden type="text" name="id_asal" id="" value="{{ $id_asal }}">
                            <input hidden type="text" name="id_pemberian" id="" value="{{ $id_pemberian }}">

                            <label for="exampleInputEmail1">Tulis Keterangan (Opsional)</label>
                            <textarea class="form-control" name="catatan" id="" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Konfirmasi Setujui" class="btn btn-primary">

                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
