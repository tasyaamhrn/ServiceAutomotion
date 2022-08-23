@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
  <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Blok</h4>
  <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
        <li class="breadcrumb-item text-muted active" aria-current="page">Blok</li>
      </ol>
    </nav>
  </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Department -->
<!-- Button Modal-->
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add Blok</button>
<!-- End Button Modal -->
<div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div id="modals" class="modal-header modal-colored-header ">
        <h4 class="modal-title" id="warning-header-modalLabel">Add Blok
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
        <form role="form text-left" method="post" action="{{ route('blok.store') }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="message-text" class="col-form-label">Name</label>
            <div>
              <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Perumahan</label>
            <div>
              <select name='id_perumahan' class='form-control'>
                @foreach($perumahan as $pr)
                <option hidden value="">
                  <center>-- Pilih --</center>
                </option>
                <option value="{{$pr->id}}">{{$pr->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Denah Blok</label>
            <div>
              <input type="file" class="form-control" name="denah">

            </div>
          </div>
          <div class="form-group text-center">
            <button id="btn" type="submit" class="btn btn-block">Submit</button>
          </div>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- End Modal Add Employee -->



<!-- Edit Modal -->

<!-- End Edit Modal -->
<br>
<br>
<!-- Table Employee -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Blok Table</h4>

        <div class="table-responsive">
          <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
            <thead>
              <tr>
                <th>Blok Name</th>
                <th>Perumahan</th>
                <th>Denah</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($blok as $b)
              <tr>
                <td>{{$b->name}}</td>
                <td>
                    @foreach ($perumahan as $p )
                        @if ($p->id==$b->id_perumahan)
                        {{$p->name}}

                        @endif
                    @endforeach
                </td>
                <td><img src="{{ url('storage').'/'.$b->denah }}" height="40px" width="40px" />
                <td class="d-flex flex-row">
                <a type="button" class="btn btn-circle btn-lg btn-warning edit text-white"  data-toggle="modal" data-target="#editModal-{{$b->id }}">
                    <span class="btn-label"><i class="far fa-edit"></i></span>
                  </a>
                  <form method="post" action="{{ route('blok.destroy', $b->id) }}">
                    @method('POST')
                    @csrf
                    <button class="btn btn-circle btn-lg btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                      <i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              <div class="modal fade" id="editModal-{{$b->id }}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Data</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="widget">
                        <div class="widget-content">
                        <form role="form text-left" method="post" action="{{route ('blok.update', $b->id)}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                          @method ('POST')

                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Name</label>
                            <div>
                              <input type="text" class="form-control" name="name" placeholder="Name" value="{{$b->name}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Perumahan</label>
                            <div>
                              <select name='id_perumahan' class='form-control'>
                                @foreach($perumahan as $per)
                                <option hidden value="{{$b->perumahan->id}}">
                                  <center>{{$b->perumahan->name}}</center>
                                </option>
                                <option value="{{$per->id}}">{{$per->name}}</option>
                                @endforeach
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Denah Blok</label>
                            <div>
                              <input type="file" class="form-control" name="denah">

                            </div>
                          </div>
                    <div class="form-group text-center">
                      <button id="btn" type="submit" class="btn btn-block">Submit</button>
                    </div>
                    </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Table Employee -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var table = $('#multi_col_order').DataTable();

    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      if ($($tr).hasClass('child')) {
        $tr = $tr.prev('.parent')
      }

      var data = table.row($tr).data();
      console.log(data);

      $('#email').val(data.email);
      $('#name').val(data.name);
      $('#address').val(data.address);
      $('#phone').val(data.phone);
      $('#avatar').val(data.avatar);
      $('#dept_id').val(data.dept_name);

      $('#editform').attr('action', 'employee/edit/' + data.id);
      $('#editmodal').modal('show');
    });
  });
</script>
@endsection
