@extends('templates.app')
@section('metatitle')
    page1
@endsection
@section('content')
    <form>
        <div class="form-group">
            <label for="">Имя</label>
            <input type="email" class="form-control" id="" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="">Сообщение</label>
            <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
@endsection