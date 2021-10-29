@include('partials.app')

<div id="wrapper">

    <!-- Sidebar -->
    @include('partials.side_bar')
    <!-- End Of Side Bar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            @include('partials.topbar')
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Ubah data di bawah ini</h1>
                    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Kepegawaian</h6>

                            </div>
                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="pb-2">
                                    <form action="{{url('update/kepegawaian') }}" method="POST">
                                        @csrf
                                        @foreach($profil as $item)
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Program Studi</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="prodi" value="{{ $item->program_studi }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No.HP Aktif</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1" name="nohp" value="{{ $item->nohp }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email Aktif</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $item->email }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Data</button>
                                        @endforeach
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        @include('partials.footer')