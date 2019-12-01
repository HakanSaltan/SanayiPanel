@extends('layouts.superapp')


@section('content')

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Role Yönetimi</h2>
                </div>
                <div class="pull-right">
                    @can('duzenler')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Yeni Rol Oluştur</a>
                    @endcan
                </div>
            </div>
        </div>


        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif


        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Adı</th>
                <th>Düzenle</th>
            </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Detay</a>
                    @can('gunceller')
                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Güncelle</a>
                    @endcan
                    @can('siler')
                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy',
                    $role->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Sil', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
            @endforeach
        </table>


        {!! $roles->render() !!}

       
        @endsection
 