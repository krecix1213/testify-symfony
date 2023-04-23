@extends('groupmanager::layouts.master')

@section('content')
    <div class="panel-body">
        <form action="{{route('group.update',$id)}}" method="post">
            {{csrf_field()}}
            <div class="input-group">
                <input type="text" name="new_name" class="form-control" placeholder="{{$group[0]->group_name}}">
                <span class="input-group-btn">
                            <button class="btn btn-info" type="submit" name="action" value="save">Zapisz</button>
                    </span>
            </div>
        </form>
    </div>
    @if(null != session('done'))
        @if(session('done')=='yes')
            <div class="alert alert-success">Zmiany zatwierdzone</div>
            @endif
        @if(session('done')=='delete')
            <div class="alert alert-success">Zmiany zatwierdzone</div>
        @endif
        @endif
    @isset($Users)
        <div class="well">Wybierz użytkowników którzy mają prawo wykonać test
            <div class="table-bordered">
                <form method="post" action="{{route('group.edit.action')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="groupName" value="{{$id}}">
                    <div>
                        @foreach($Users as $i => $user)
                                @if($user->status == "belong")
                                    <input type="checkbox" name="user[{{$user->id}}][check]" checked>{{$user->name}}
                                    <input type="hidden" name="user[{{$user->id}}][set]" value="1">
                                @else
                                    <input type="checkbox" name="user[{{$user->id}}][check]" >{{$user->name}}
                                    <input type="hidden" name="user[{{$user->id}}][set]" value="0">
                                @endif
                        @endforeach
                        <button type="submit" class="btn-success">Zapisz</button>
                    </div>
                </form>
            </div>
        </div>
    @endisset
@stop
