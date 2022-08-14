<!DOCTYPE html>
<html>
<head>
	<title>Laporan Complaint</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Complaint</h4>

	</center>

	<table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>Customer Name</th>
                <th>Category</th>
                <th>Type</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
                {{-- <th>Complaint Attachment</th>
                <th>Response</th> --}}
                <th>Resolved Date</th>
                <th>Feedback Score</th>
                <th>Feedback Description</th>
            </tr>
        </thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($complaint as $c)
            <tr>
                <td>{{ $i++ }}</td>
                <td>
                  {{$c->customer->name}}
                  <!-- @foreach ($customer as $cus)
                  @if($cus->id == $c->cust_id)
                  {{$cus->name}}
                  @endif
                  @endforeach -->

                </td>
                <td>
                    {{$c->category->name}}
                    <!-- @foreach ($category as $cat)
                    @if($cat->id == $c->category_id)
                    {{$cat->name}}
                    @endif
                    @endforeach -->

                  </td>
                  <td>
                    {{$c->type}}
                  </td>
                  <td>
                    {{$c->judul}}
                  </td>
                <td>{{$c->deskripsi}}</td>
                <td>{{$c->tanggal}}</td>
                <td>{{$c->status}}</td>
                {{-- <td>
                    <a class="fa fa-download" aria-hidden="true"
                        href="{{ route('tindak-lanjut-complaint.download', $c->id) }}/" role="button">Download</a>
                </td> --}}
                {{-- @if ($c->tindak_lanjut == null)
                <td>Gambar belom di upload</td>
                @elseif ($c->tindak_lanjut) --}}
                {{-- <td>
                    <a class="fa fa-download" aria-hidden="true"
                        href="{{ route('bukti-complaint.download', $c->id) }}/" role="button">Download</a>
                </td>
                @endif --}}
                @if ($c->tgl_penyelesaian == null)
                <td>none</td>
                @elseif ($c->tgl_penyelesaian)
                <td>{{($c->tgl_penyelesaian)}}</td>
                {{-- <td>{{$c->tgl_penyelesaian}}</td> --}}
                {{-- <td>{{$c->feedback_score}}</td> --}}
                @endif
                @if ($c->feedback_score <= 3)
                <td style="color:red; font-weight:bold;">{{$c->feedback_score}}</td>
                @elseif ($c->feedback_score > 3)
                <td style="color:#32CD32; font-weight:bold;">
                    {{$c->feedback_score}}
                </td>
                @endif
                @if ($c->feedback_score <= 3)
                <td style="color:red; font-weight:bold;">{{$c->feedback_deskripsi}}</td>
                @elseif ($c->feedback_score > 3)
                <td style="color:#32CD32; font-weight:bold;">
                    {{$c->feedback_deskripsi}}
                </td>
                @endif


              </tr>

			@endforeach
		</tbody>
	</table>

</body>
</html>
