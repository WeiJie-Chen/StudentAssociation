@extends('layouts.master')
@section('title','活動報名')
@section('pagename','活動報名')
@section('content')
<script language="javascript">
    var number = 0;
    function getForm(arrIndex,trueID){
        $('#EditName').val($('#item_'+arrIndex).children().html());
        $('#EditStart').val($('#item_'+arrIndex).children().next().html());
        $('#EditEnd').val($('#item_'+arrIndex).children().next().next().html());
        $('#index').attr('action','{{route('apply.update')}}/'+trueID);
    }
        function delIndex(trueID){
        $('#delIndex').attr('action','{{route('apply.delete')}}/'+trueID);
    }
</script>
<button class="btn btn-success btn-lg" style="position: relative;left: 87%" data-toggle="modal" data-target="#AddForm">新增</button>

    <table class="tableStyle">
    <tr>
        <td>活動名稱</td>
        <td>報名開始日期</td>
        <td>報名結束日期</td>
        <td></td>
    </tr>
    @foreach($results as $key => $item)
    <tr class="tableContent" id= "item_{{$key}}">
        <td><?=$item->name?></td>
        <td><?=$item->start_at?></td>
        <td><?=$item->end_at?></td>
        <td>
            <button class="btn btn-danger bnt-lg" style="font-size: 20px;" onclick = "delIndex({{$item->id}})" data-toggle="modal" data-target="#DelForm">刪除</button>
            <button class="btn btn-info bnt-lg" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</button>
        </td>
    </tr>
    @endforeach
    </table>
    <center><?=$results->render()?></center>
@endsection
@section('AddForm')
    {!!Form::open([ 'class'=>'form-horizontal', 'method' => 'post', 'route' => 'apply.store'])!!}
        <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('AcuivityName','活動名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control', 'id' => 'AcuivityName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('AcuivityNameStart','開始日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::date('start_at',\Carbon\Carbon::now())!!}
                    </div>
                </div>      
                <div class="form-group">
                {!!Form::label('AcuivityNameEnd','結束日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                    {!!Form::date('end_at',\Carbon\Carbon::tomorrow())!!}
                    </div>
                </div>              
        </div>
        <div class="modal-footer">
            {!!Form::button('關閉',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('儲存',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('EditForm')
    {!!Form::open(['class'=> 'form-horizontal', 'id' => 'index', 'role'=> 'form', 'method' => 'patch'])!!}
        <div class="modal-body">
                <div class="form-group">
                {!!Form::label('EditName','活動名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control' , 'id' => 'EditName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('EditStart','開始日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('start_at',null,['class' => 'form-control' , 'id' => 'EditStart', 'placeholder' => 'yyyy-MM-dd HH:mm:ss'])!!}
                    </div>
                </div>      
                <div class="form-group">
                    {!!Form::label('EditEnd','結束日期',['class' => 'col-sm-2 control-label'])!!}                    
                    <div class="col-sm-10">
                        {!!Form::text('end_at',null,['class' => 'form-control' , 'id' => 'EditEnd', 'placeholder' => 'yyyy-MM-dd HH:mm:ss'])!!}
                    </div>
                </div>         
        </div>
        <div class="modal-footer">
            {!!Form::button('取消',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('DelForm')
    {!!Form::open(['class'=> 'form-horizontal', 'id' => 'delIndex', 'role'=> 'form', 'method' => 'delete'])!!}
        <div class="modal-body">
            <center>          
                {!!Form::submit('確定',['class' => 'btn btn-primary'])!!}   
                {!!Form::button('取消',['class' => 'btn btn-warning', 'data-dismiss' => 'modal' ])!!}             
            </center>
        </div>
    {!!Form::close()!!}
@endsection