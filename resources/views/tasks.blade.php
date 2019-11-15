@extends('layouts.app')
@section('content')
<!-- Bootstrap шаблон... -->
<div class="panel-body">
    <!-- Отображение ошибок проверки ввода -->
    @include('common.errors')
    <!-- Форма новой задачи -->
    <form action="{{ url('tasks') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}
        <!-- Имя задачи -->
        <div class="form-group">
            <label for="task-name" class="col-sm-3 control-label">{{trans('tasks.template.task')}}</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="task-name" class="form-control">
            </div>
        </div>
        <!-- Кнопка добавления задачи -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> {{trans('tasks.template.add_task')}}
                </button>
            </div>
        </div>
    </form>
</div>

<!-- TODO: Текущие задачи -->
<!-- Текущие задачи -->
@if (count($tasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        {{trans('tasks.template.all_tasks')}}
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

	    <!-- Заголовок таблицы -->
	    <thead>
		<tr>
		    <th>{{trans('tasks.template.task')}}</th>
		    <th>{{trans('tasks.template.action')}}</th>
		</tr>
	    </thead>

	    <!-- Тело таблицы -->
	    <tbody>
		@foreach ($tasks as $task)
		<tr>
		    <!-- Имя задачи -->
		    <td class="table-text">
			<div>{{ $task->name }}</div>
		    </td>

		    <td>
			<form action="{{url('tasks/'.$task->id)}}" method="post">
			    {{csrf_field()}}
			    {{method_field('DELETE')}}  
			    <button><i class="fa fa-trash"></i></button> 
			</form>
		    </td>
		</tr>
		@endforeach
	    </tbody>
        </table>
    </div>
</div>
@endif
@endsection
