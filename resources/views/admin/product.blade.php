@extends('layouts.app')
@section('content')
<!-- Page -->
@section('page')

<div class="col-12 align-self-center">
    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Product</h4>
    <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="index.html" class="text-muted">Dashboard</a></li>
                <li class="breadcrumb-item text-muted active" aria-current="page">Product</li>
            </ol>
        </nav>
    </div>
</div>
@endsection
<!-- End Page -->
<!-- Modal Add Employee -->
<!-- Button Modal-->
<button type="button" id="add" class=" btn btn-rounded" data-toggle="modal" data-target="#warning-header-modal">Add
    Product</button>
<!-- End Button Modal -->
<div id="warning-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div id="modals" class="modal-header modal-colored-header ">
                <h4 class="modal-title" id="warning-header-modalLabel">Add Product
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
                <form role="form text-left" method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Blok</label>
                        <div>
                          <select name='blok' class='form-control'>
                            @foreach($blok as $bk)
                            <option hidden value="">
                              <center>-- Pilih --</center>
                            </option>
                            <option value="{{$bk->id}}">{{$bk->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">No.Kavling</label>
                        <div>
                            <input type="text" class="form-control" name="no_kavling" placeholder="No.Kavling">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Type</label>
                        <div>
                            <input type="number" class="form-control" name="type" placeholder="Type">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Luas Tanah</label>
                        <div>
                            <input type="number" class="form-control" name="luas_tanah" placeholder="Luas Tanah">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Price</label>
                        <div>
                            <input type="number" class="form-control" name="price" placeholder="Price">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Status</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
                            <option selected>Choose...</option>
                            <option value="Available">Available</option>
                            <option value="Booked">Booked</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Dinding</label>
                        <div>
                            <input type="text" class="form-control" name="dinding" placeholder="Dinding">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Pondasi</label>
                        <div>
                            <input type="text" class="form-control" name="pondasi" placeholder="Pondasi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Lantai</label>
                        <div>
                            <input type="text" class="form-control" name="lantai" placeholder="Lantai">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Rangka Atap</label>
                        <div>
                            <input type="text" class="form-control" name="rangka_atap" placeholder="Rangka Atap">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Penutup Atap</label>
                        <div>
                            <input type="text" class="form-control" name="penutup_atap" placeholder="Penutup Atap">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Daun Pintu</label>
                        <div>
                            <input type="text" class="form-control" name="daun_pintu" placeholder="Daun Pintu">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Plafon</label>
                        <div>
                            <input type="text" class="form-control" name="plafon" placeholder="Plafon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Kusen</label>
                        <div>
                            <input type="text" class="form-control" name="kusen" placeholder="Kusen">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Kamar Mandi</label>
                        <div>
                            <input type="text" class="form-control" name="kamar_mandi" placeholder="Kamar Mandi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Sumber Air</label>
                        <div>
                            <input type="text" class="form-control" name="sumber_air" placeholder="Sumber Air">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Listrik</label>
                        <div>
                            <input type="text" class="form-control" name="listrik" placeholder="Listrik">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tanah Lebih</label>
                        <div>
                            <input type="number" class="form-control" name="tanah_lebih" placeholder="Tanah Lebih">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Discount</label>
                        <div>
                            <input type="number" class="form-control" name="discount" placeholder="Discount">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Image</label>
                        <div>
                            <input type="file" class="form-control" name="image">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Image 2</label>
                        <div>
                            <input type="file" class="form-control" name="imagedua">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Image 3</label>
                        <div>
                            <input type="file" class="form-control" name="imagetiga">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Image 4</label>
                        <div>
                            <input type="file" class="form-control" name="imageempat">

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
                <h4 class="card-title">Product Table</h4>

                <div class="table-responsive">
                    <table id="multi_col_order" class="table table-striped table-bordered display no-wrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>Blok</th>
                                <th>No.Kavling</th>
                                <th>Type</th>
                                <th>Luas(m<sup>2</sup>)</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Dinding</th>
                                <th>Pondasi</th>
                                <th>Lantai</th>
                                <th>Rangka Atap</th>
                                <th>Penutup Atap</th>
                                <th>Daun Pintu</th>
                                <th>Plafon</th>
                                <th>Kusen</th>
                                <th>Kamar Mandi</th>
                                <th>Sumber Air</th>
                                <th>Listrik</th>
                                <th>Tanah Lebih</th>
                                <th>Discount(%)</th>
                                <th>Image</th>
                                <th>Image 2</th>
                                <th>Image 3</th>
                                <th>Image 4</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $p)
                            <tr>
                                <td>
                                    @foreach ($blok as $bk )
                                        @if ($bk->id==$p->blok)
                                        {{$bk->name}}

                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$p->no_kavling}}</td>
                                <td>{{$p->type}}</td>
                                <td>{{$p->luas_tanah}}</td>
                                <td>@currency($p->price)</td>
                                <td>{{$p->status}}</td>
                                <td>{{$p->dinding}}</td>
                                <td>{{$p->pondasi}}</td>
                                <td>{{$p->lantai}}</td>
                                <td>{{$p->rangka_atap}}</td>
                                <td>{{$p->penutup_atap}}</td>
                                <td>{{$p->daun_pintu}}</td>
                                <td>{{$p->plafon}}</td>
                                <td>{{$p->kusen}}</td>
                                <td>{{$p->kamar_mandi}}</td>
                                <td>{{$p->sumber_air}}</td>
                                <td>{{$p->listrik}}</td>
                                <td>{{$p->tanah_lebih}}</td>
                                <td>{{$p->discount}}</td>
                                <td><img src="{{ url('storage').'/'.$p->image }}" height="40px" width="40px" />
                                    <td><img src="{{ url('storage').'/'.$p->imagedua }}" height="40px" width="40px" />
                                        <td><img src="{{ url('storage').'/'.$p->imagetiga }}" height="40px" width="40px" />
                                            <td><img src="{{ url('storage').'/'.$p->imageempat }}" height="40px" width="40px" />
                                <td class="d-flex flex-row">
                                    <a id="edit" class="btn btn-circle btn-lg btn-warning edit" type="button" data-toggle="modal" data-target="#editModal{{$p->id }}">
                                        <span class="btn-label"><i class="far fa-edit"></i></span>
                                    </a>
                                    <form method="post" action="{{ route('product.destroy', $p->id) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-circle btn-lg btn-danger" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini ?')">
                                            <i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            <!-- Modal Edit -->
                            <div id="editModal{{$p->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="warning-header-modalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div id="modals" class="modal-header modal-colored-header ">
                                            <h4 class="modal-title" id="warning-header-modalLabel">Edit Product
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form role="form text-left" method="post" action="{{ route('product.update', $p->id) }}" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                {{method_field('PUT')}}
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Blok</label>
                                                    <div>
                                                      <select name='blok' class='form-control'>
                                                        @foreach($blok as $bk)
                                                        <option selected>{{$p->blok}}</option>
                                                          <center>-- Pilih --</center>
                                                        </option>
                                                        <option value="{{$bk->id}}">{{$bk->name}}</option>
                                                        @endforeach
                                                      </select>
                                                    </div>
                                                  </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">No.Kavling</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="no_kavling" placeholder="No.Kavling" value="{{$p->no_kavling}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Type</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="type" placeholder="Type" value="{{$p->type}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Luas</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="luas_tanah" placeholder="Luas" value="{{$p->luas_tanah}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Price</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="price" placeholder="Price" value="{{$p->price}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    {{-- <label for="message-text" class="col-form-label">Blok</label> --}}
                                                    <div>
                                                        <label class="mr-sm-2" for="inlineFormCustomSelect">Status</label>
                                                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="status">
                                                            <option selected>{{$p->status}}</option>
                                                            <option value="Available">Available</option>
                                                            <option value="Booked">Booked</option>
                                                        </select>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Dinding</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="dinding" value="{{$p->dinding}}" placeholder="Dinding">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Pondasi</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="pondasi" value="{{$p->pondasi}}" placeholder="Pondasi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Lantai</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="lantai" value="{{$p->lantai}}" placeholder="Lantai">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Rangka Atap</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="rangka_atap" value="{{$p->rangka_atap}}" placeholder="Rangka Atap">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Penutup Atap</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="penutup_atap" value="{{$p->penutup_atap}}" placeholder="Penutup Atap">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Daun Pintu</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="daun_pintu" value="{{$p->daun_pintu}}" placeholder="Daun Pintu">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Plafon</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="plafon" value="{{$p->plafon}}" placeholder="Plafon">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Kusen</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="kusen" value="{{$p->kusen}}" placeholder="Kusen">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Kamar Mandi</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="kamar_mandi" value="{{$p->kamar_mandi}}" placeholder="Kamar Mandi">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Sumber Air</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="sumber_air" value="{{$p->sumber_air}}" placeholder="Sumber Air">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Listrik</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="listrik" value="{{$p->listrik}}" placeholder="Listrik">
                                                    </div>
                                                </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Tanah Lebih</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="tanah_lebih" placeholder="Tanah Lebih" value="{{$p->tanah_lebih}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Discount</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="discount" placeholder="Discount" value="{{$p->discount}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Image</label>
                                                    <div>
                                                      <input type="file" class="form-control" name="image">
                                                      <label><b>*Jika tidak ada kosongkan saja</b></label>
                                                    </div>
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Image 2</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="imagedua">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Image 3</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="imagetiga">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Image 4</label>
                                                    <div>
                                                        <input type="file" class="form-control" name="imageempat">

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
                            <!-- End Modal Edit -->
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
@endsection
