@extends('layouts.app', ['page' => 'jejak-audit'])
@section('title', 'Jejak Audit')

@section('breadcrumb-items')
<li class="breadcrumb-item">Jejak Audit</li>
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
         <div class="col-xl-12">
            <div class="card  card-with-border">
                <div class="card-header">
                  <h5>Jejak Audit</h5>
                </div>
                <div class="table-responsive p-3">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Model</th>
                        <th scope="col">Event</th>
                        <th scope="col">Pengguna</th>
                        <th scope="col">Old</th>
                        <th scope="col">New</th>
                        <th scope="col">IP</th>
                        <th scope="col">Tarikh</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($audits as $audit)
                        <tr>
                            <th scope="row">{{ $audit->id }}</th>
                            <td>{{ $audit->auditable_type }}</td>
                            <td>{{ $audit->event }}</td>
                            <td>{{ $audit->user->email }}</td>
                            <td>
                                <button class="example-popover btn btn-light btn-xs" type="button" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="bottom" title="" data-offset="-20px -20px" data-content="'{{ $audit->old_values }}'" data-original-title="">...</button>
                            </td>
                            <td>
                                <button class="example-popover btn btn-light btn-xs" type="button" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="bottom" title="" data-offset="-20px -20px" data-content="'{{ $audit->new_values }}'" data-original-title="">...</button>
                            </td>
                            <td>{{ $audit->ip_address }}</td>
                            <td>{{ $audit->created_at}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              {{ $audits->links() }}
         </div>
    </div>
</div>
@endsection
