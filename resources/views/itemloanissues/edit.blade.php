@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading"><big>EDIT ISSUED LOAN ACCOUNT ITEM</big></strong></big>&nbsp&nbsp&nbsp&nbsp <big>issue</big> <span class="label label-primary"><big>#{{$item_loanissue->loanissue_id}}</big></span></div>
           
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="/itemloanissues/{{$item_loanissue->id}}">
                    {{ csrf_field() }}
                      <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label class="col-md-4 control-label">item name</label>
                        <div class="col-md-4">
                            <select id="item"  name="item" class="form-control" data-width="100%">
                                <option value="{{$item_loanissue->item_id}}" selected="{{$item_loanissue->item->name}}">
                                    {{$item_loanissue->item->name}}
                                </option>
                            </select>
                            <input type="hidden" id="item_id"  name="item_id" value="{{$item_loanissue->item_id}}"/>
                            <input type="hidden" id="loanissue_id"  name="loanissue_id" value="{{$item_loanissue->loanissue_id}}"/>
                              quantity in store <span class="label label-danger" id="quantity_badge"></span>   
                        </div>

                        </div>
                       
                        
                   

                    <div class="form-group">
                        <label class="col-md-4 control-label">amount</label>
                        <div class="col-md-2">
                            <input id="amount" type="text" class="form-control" name="amount" value="{{$item_loanissue->amount}}" >
                        </div>
                    </div>
                    
                    <div class="form-group">
                            <label class="col-md-4 control-label">return date</label>
                            <div class="col-md-2">
                                <input id="datepicker" type="text" class="datepicker form-control" name="return_date" value="{{$item_loanissue->return_date}}">
                            </div>
                        </div>    

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-plus"></i> update
                            </button>
                        </div>
                    </div>

                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

@include('layouts.suggest')

<script>
    var item_stock_amount=0;
    getStoreQuantitiy(parseInt($('#item_id').val()))
   
    $("#amount").keyup(function(){checkitem_stock_amount();});

    function checkitem_stock_amount(){
    
        if(item_stock_amount==0){
            alert("please select your item from item box");
        } 
        else{
            if(item_stock_amount<$("#amount").val()){
                alert($( "#item option:selected" ).text()+"'s quanitiy in stock is "+item_stock_amount+". apply below that")
                $("#amount").focus();
                $("#amount").val('');
            }
        }
    }
    
    GetSuggestions("item","name","items");

    $('#item').on('select2:select', function (evt) {
        getStoreQuantitiy(evt.params.data.id);
   
    });
    
    function getStoreQuantitiy (item_id) {
        $('#item_id').val(item_id);
        $.ajax({
            type:'GET',
            url: '/checkquantity',
            data:'q='+item_id,
            success:function(data){
                item_stock_amount=data;
                $('#quantity_badge').html(item_stock_amount);
            
            }
        });
    }


</script>

@endsection 

