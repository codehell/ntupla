@extends('layouts.app')

@section('menu')
    @include('tuple.layouts.menu')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crea un nuevo elemento</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('tuple.index') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Cuerpo del mensaje</label>
                                <div class="col-md-6">
                                    <textarea id="message"
                                           class="form-control"
                                           name="message"
                                           required autofocus
                                    >{{ old('message') }}</textarea>

                                    @if ($errors->has('message'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Categoria</label>
                                <div class="col-md-6">
                                    <select id="category" class="form-control" name="category">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->predetermined ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                                <label for="selectors" class="col-md-4 control-label">Selector</label>

                                <div class="col-md-6">
                                    <input id="selectors" type="text" class="form-control" name="selectors">

                                    @if ($errors->has('selectors'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('selectors') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Agregar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Tupla: {{ $category->name }}</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <ul>
                                    @foreach ($tuples as $tuple)
                                        <li>{{ $tuple->user->name }}: {{  $tuple->message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection