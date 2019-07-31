@extends('templates.company.default')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Detail Pemesanan
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="{{ url('users') }}" class="fa fa-arrow-left btn btn-warning" > Kembali</a>
              </li>
            </ul>
            <div class="tab-content">
            <div class="box-body">
                <table id="table-driver" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th style="width: 40px">Name</th>
                    <th style="width: 40px">Email</th>
                    <th style="width: 80px">Photo</th>
                    <th style="width: 50px">No Hp</th>
                    <th style="width: 100px">Alamat</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                      $no = 1;
                    @endphp

                    {{-- cek data di database --}}
                    @if(sizeof($data_user)>0)
                      {{-- @foreach($data_pesan as $pesans) --}}
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>
                            {{ $data_user->name }}
                          </td>
                          <td>
                            {{ $data_user->email }}
                          </td>
                          <td align="center"><a href="{{asset('img/'.$data_user->avatar)}}" rel="zoom-id:zoom;opacity-reverse:true"> <img src="{{asset('img/'.$data_user->avatar)}}" width="45px"; height="45px";></a></td>
                          {{-- <td>{{ $data_user->avatar }}</td> --}}
                          <td>{{ $data_user->phone }}</td>
                          <td>{{ $data_user->address }}</td>
                        </tr>
                      {{-- @endforeach --}}

                    @else
                      <tr>
                        <td class="text-center" colspan="6"><i>Tidak ada data</i></td>
                      </tr>
                    @endif

                  </tbody>
                  <tfoot>
                  </tfoot>
                </table>
            </div>
            </div>
              <!-- /.box-body -->
            <div class="box-body">
              <div class="tab-pane">
                <div id="grafikPesan">
                  
                </div>
              </div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
        </div>

    </section>
    <!-- /.content -->
@endsection