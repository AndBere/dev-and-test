@extends('admin._layout')
@section('title', 'Сообщения из форм в паблике')
@section('content')
    @component('admin._include.card')
      

        @slot('cardFilters')
{{--            @includ('admin.questions._filters')--}}
        @endslot

        @slot('cardTitle')
            <span class="font-weight-bold mr-3">Сообщения</span>
        @endslot

        @slot('cardBody')
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                   
                    <th class="text-center">№</th>
                    <th><input type="checkbox" id="master"></th>
                    <th>Сообщение</th>
                    <th>Удалить <button class="btn btn-primary delete_all" data-url="{{ url('questionsDeleteAll') }}">Delete All</button></th>
                    <th>Дата</th>
                    <th>Имя | Телефон | E-mail</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($questions) and $questions->count() > 0)
                    @foreach($questions as $question)
                        @include('_table')
                    @endforeach
                @else

                @endif
                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection
