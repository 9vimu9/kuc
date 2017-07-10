@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>ADD ITEM</big></div>
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/items">
                        {{ csrf_field() }}

                         <div class="form-group">
                            <label class="col-md-4 col-sm-4 control-label">category</label>
                            <div class="col-md-3 col-sm-3">
                                 <select id="cat"  name="cat" class="form-control" data-width="100%">
                                   <option value="{{session('cat_id')}}" selected="{{session('cat_name')}}">
                                       {{session('cat_name')}}
                                   </option>
                                 </select>
                                 <input type="hidden" id="cat_id"  name="cat_id" value="{{session('cat_id')}}" />
                            </div>


                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">name</label>
                            <div class="col-md-4">
                                <input id="name" type="text" class="form-control" name="name" value={{old('name')}}>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">code</label>
                            <div class="col-md-3">
                                <input id="code" type="text" class="form-control" name="code" value="{{session('cat_symbol')}}/"}}>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">location</label>
                            <div class="col-md-3">
                                <input id="location" type="text" class="form-control" name="location" value={{old('location')}}>
                            </div>
                        </div>

                          <div class="form-group">
                            <label class="col-md-4 control-label">max level</label>
                            <div class="col-md-1">
                                <input id="max" type="text" class="form-control" name="max" value={{old('max')}}>
                            </div>

                             <label class="col-md-1 control-label">min level</label>
                            <div class="col-md-1">
                                <input id="min" type="text" class="form-control" name="min" value={{old('min')}}>
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label">reorder level</label>
                            <div class="col-md-1">
                                <input id="reorder" type="text" class="form-control" name="reorder" value={{old('reorder')}}>
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-plus"></i> create
                                </button>
                            </div>
                        </div>
                    </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section("script")

@include('layouts.suggest')
<script>

    GetSuggestions("cat","name","cats");

     $('#cat').on('select2:select', function (evt) {
         var cat_id=evt.params.data.id;
           $('#cat_id').val(cat_id);
           GetColumnData(cat_id,"symbol","cats","#code");


    });



  $("#max,#min,#reorder").change(function(){

      //  checkReorder();
        var max=parseInt($('#max').val());
        var min=parseInt($("#min").val());
        var reorder=parseInt($("#reorder").val());


        if(max<=min){

              $(document).trigger("add-alerts", [
                {
                "message": "check your max and min  values",
                "priority": 'danger'
                }
                ]);
            $(this).focus();
            $(this).val('');
        }

        if( max<=reorder || min>=reorder){

           $(document).trigger("add-alerts", [
                {
                "message": "check your reorder value",
                "priority": 'danger'
                }
                ]);
           $("#reorder").focus();
          $("#reorder").val('');
     }

    });
</script>

@endsection
