@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
  <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Customer</h4>
  <div class="d-flex align-items-center">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0 p-0">
        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
        <li class="breadcrumb-item text-muted active" aria-current="page">Customer</li>
      </ol>
    </nav>
  </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Employee -->
<!-- Button Modal-->
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add Customer</button>
<!-- End Button Modal -->
<div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div id="modals" class="modal-header modal-colored-header ">
        <h4 class="modal-title" id="warning-header-modalLabel">Add Customer
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
        <form role="form text-left" method="post" action="{{ route('customer.store') }}" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Email</label>
            <div>
              <input type="email" class="form-control" name="email" placeholder="Email">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Password</label>
            <div>
              <input type="password" class="form-control" name="password" placeholder="password">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">NIK</label>
            <div>
              <input type="text" class="form-control" name="nik" placeholder="Name">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Name</label>
            <div>
              <input type="text" class="form-control" name="name" placeholder="Name">
            </div>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Address</label>
            <div>
              <textarea class="form-control" name="address"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label">Phone</label>
            <div>
              <input type="text" class="form-control" name="phone" placeholder="Phone">
            </div>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Avatar</label>
            <div>
              <input type="file" class="form-control" name="avatar">
              <label><b>*Jika tidak ada kosongkan saja</b></label>
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

<br>
<br>
<!-- Table Employee -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Customer Table</h4>

        <div class="table-responsive">
          <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
            <thead>
              <tr>
                <th>Email</th>
                <th>NIK</th>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Avatar</th>
                <th>KTP</th>
                <th>Status Account</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($customer as $c)
              <tr>
                <td>{{$c->user->email}}</td>
                <td>{{$c->nik}}</td>
                <td>{{$c->name}}</td>
                <td>{{$c->address}}</td>
                <td>{{$c->phone}}</td>
                @if ($c->avatar==null)
                <td><i>None</i></td>
                @elseif($c->avatar)
                <td><img src="{{ url('storage').'/'.$c->avatar }}" height="40px" width="40px" />
                @endif
                <td>
                    <a class="fa fa-download" aria-hidden="true"
                        href="{{ route('ktp.download', $c->id) }}/" role="button">Download</a>
                </td>
                <td>{{$c->status}}</td>


                <td class="d-flex flex-row">

                  <button id="edit" type="button" class="btn btn-circle btn-lg btn-warning edit" data-toggle="modal" data-target="#editModal-{{$c->id}}">
                    <span class="btn-label"><i class="far fa-edit"></i></span>
                  </button>
                  <button id="edit" type="button" class="btn btn-circle btn-lg btn-primary edit" data-toggle="modal" data-target="#editModal1-{{$c->id}}">
                    <span class="btn-label"><i class="far fa-user"></i></span>
                  </button>
                  <form method="post" action="{{url('customer/delete/'.$c->user_id)}}">
                    @method('DELETE')
                    @csrf
                    @if (Auth::user()->role_id == 1)
                    <button class="btn btn-circle btn-lg btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                      <i class="fa fa-trash"></i></button>
                    @endif

                  </form>
                </td>
              </tr>
              <div class="modal fade" id="editModal1-{{$c->id }}">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Validasi Account</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="widget">
                        <div class="widget-content">
                        <form role="form text-left" method="post" action="{{url('customer/validasi/'.$c->id)}}" enctype="multipart/form-data">
                          {{csrf_field()}}

                          <div class="form-group">
                            {{-- <label for="message-text" class="col-form-label">Blok</label> --}}
                            <div>
                                <label class="mr-sm-2" for="inlineFormCustomSelect">Status</label>
                                <select class="custom-select mr-sm-2" id="status" name="status">
                                    <option selected>{{$c->status}}</option>
                                    <option value="waiting">Waiting</option>
                                    <option value="Validated">Validated</option>
                                    <option value="ditolak">Rejected</option>
                                </select>
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
              <div class="modal fade" id="editModal-{{$c->id }}">
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
                        <form role="form text-left" method="post" action="{{url('customer/edit/'.$c->id)}}" enctype="multipart/form-data">
                          {{csrf_field()}}

                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <div>
                              <input type="email" class="form-control" name="email" placeholder="Email" value="{{$c->user->email}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">NIK</label>
                            <div>
                              <input type="text" class="form-control" name="nik" placeholder="NIK" value="{{$c->nik}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Name</label>
                            <div>
                              <input type="text" class="form-control" name="name" placeholder="Name" value="{{$c->name}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Address</label>
                            <div>
                              <input class="form-control" name="address" value="{{$c->address}}">
                            </div>
                          </div>

                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Phone</label>
                            <div>
                              <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{$c->phone}}">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="message-text" class="col-form-label">Avatar</label>
                            <div>
                              <input type="file" class="form-control" name="avatar">
                              <label><b>*Jika tidak ada kosongkan saja</b></label>
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
@endsection
