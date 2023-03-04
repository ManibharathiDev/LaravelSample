<!-- Extends template page -->
@extends('layout.app')

<!-- Specify content -->
@section('content')
<script>
function deleteRow(row) {
  var i = row.parentNode.parentNode.rowIndex;
  document.getElementById('POITable').deleteRow(i);
}

function  validate(id)
{
	var price = document.getElementById("price"+id).value;
	var qty = document.getElementById("qty"+id).value;
	var discount = document.getElementById("discount"+id).value;
	//var price = document.getElementById("price"+id).value;
	var amount=0;
	if(price>0 && qty>0){ amount=price*qty;}
	if(amount>0 && discount>0){amount=amount-discount; }
	document.getElementById("value"+id).value=amount;
}
function insRow() {
	
	 var parent = document.getElementById('addrpw');
 // var newChild = '<p>Child ' + childNumber + '</p>';
 var xTable=document.getElementById('POITable');
  var tr=document.createElement('tr');
  var table = document.getElementById("rownumber").value;

   html="<td>#</td><th><input type='text' name='order["+table+"][item]'  id='item"+table+"' value='' required></td>";
	html +="<td><input type='text' name='order["+table+"][uom]' value='' id='uom"+table+"'  required></td>";
	html +="<td><input type='text' name='order["+table+"][qty]' value='' id='qty"+table+"' onblur='validate("+table+")' required></td>";
	html +="<td><input type='text' name='order["+table+"][price]' value='' id='price"+table+"'  onblur='validate("+table+")'  required></td>";
	html +="<td><input type='text' name='order["+table+"][discount]' value='' id='discount"+table+"'  onblur='validate("+table+")'  required></td>";
	html +="<td><input type='text' name='order["+table+"][value]' readonly value='' id='value"+table+"'  onblur='validate("+table+")'  required></td>";
	//html +="<!--<td><a href='#' id='delete"+table+"' >Delete</a></td>-->";
				 
				 
      tr.innerHTML =html;
      xTable.appendChild(tr);
	  
	  document.getElementById("rownumber").value=parseInt(table)+parseInt(1);
	  /*
  html="<tr><td>#</td><th><input type='text' name='order[+"table"+][item]' value='' required></td>";
	html +="<td><input type='text' name='order[+"table"+][uom]' value='' required></td>";
	html +="<td><input type='text' name='order[+"table"+][qty]' value='' required></td>";
	html +="<td><input type='text' name='order[+"table"+][price]' value='' required></td>";
	html +="<td><input type='text' name='order[+"table"+][discount]' value='' required></td>";
	html +="<td><input type='text' name='order[+"table"+][value]' value='' required></td>";
	html +="<td><a href='#'>Delete</a></td></tr>";
		*/		 
  //parent.appendChild(html); 
  //$('#myTable').append('<tr><td><input type="text" class="fname" /></td><td><input type="button" value="Delete" /></td></tr>')
}
</script>
<h3>View Order</h3>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">

        <!-- Alert message (start) -->
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
            {{ Session::get('message') }}
        </div>
        @endif
        <!-- Alert message (end) -->
     
        <div class="actionbutton">
                      
            <a class='btn btn-info float-right' href="{{route('order.list')}}">List</a>
                      
        </div>
                      
            <form action="{{route('order.update',$order->id)}}" method="post" id="subjectForm">
                {{csrf_field()}}
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Order No <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="order_no" class="form-control col-md-12 col-xs-12" name="order_no"   required="required" type="text" value="{{$order->order_no}}" readonly>

                        @if ($errors->has('order_no'))
                          <span class="errormsg">{{ $errors->first('order_no') }}</span>
                        @endif
                    </div>
                </div>
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Order  date <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="order_date" class="form-control col-md-12 col-xs-12" name="order_date"  required="required" type="date" value="{{$order->order_date}}" readonly>

                        @if ($errors->has('order_date'))
                          <span class="errormsg">{{ $errors->first('order_date') }}</span>
                        @endif
                    </div>
                </div>
				
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer No <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="customer_no" class="form-control col-md-12 col-xs-12" name="customer_no"   required="required" type="text" value="{{$order->customer_no}}" readonly>

                        @if ($errors->has('customer_no'))
                          <span class="errormsg">{{ $errors->first('customer_no') }}</span>
                        @endif
                    </div>
                </div>
				
				<div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Customer Name <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="customer_name" class="form-control col-md-12 col-xs-12" name="customer_name"   required="required" type="text" value="{{$order->customer_name}}" readonly>

                        @if ($errors->has('customer_name'))
                          <span class="errormsg">{{ $errors->first('customer_name') }}</span>
                        @endif
                    </div>
                </div>
				 
                 <table id="POITable">
				 <thead>
				 <tr>
				 <th>#</th>
				 <th>Item</th>
				 <th>UOM</th>
				 <th>Qty</th>
				 <th>Price</th>
				 <th>discount</th>
				 <th>value</th>
				 
				 </tr>
				 </thead>
				  <tbody id='addrpw'>
				 <?php 
				 $sno=0;
				 foreach($order->items as $row)
				 {
				 ?>
				 <tr>
				 <td>#</td><th><input type='text' name='order[{{$sno}}][item]'  readonly  id='item{{$sno}}' value='{{$row->item}}' required></td>
					<td><input type='text' name='order[{{$sno}}][uom]' readonly value='{{$row->uom}}' id='uom{{$sno}}'  required></td> 
				<td><input type='text' name='order[{{$sno}}][qty]' readonly value='{{$row->quantitty}}' id='qty{{$sno}}' onblur='validate({{$sno}})' required></td>
				<td><input type='text' name='order[{{$sno}}][price]' readonly value='{{$row->price}}' id='price{{$sno}}'  onblur='validate({{$sno}})'  required></td>
				<td><input type='text' name='order[{{$sno}}][discount]' readonly value='{{$row->discount}}' id='discount{{$sno}}'  onblur='validate({{$sno}})'  required></td>
				<td><input type='text' name='order[{{$sno}}][value]' readonly value='{{$row->value}}' id='value{{$sno}}'  onblur='validate({{$sno}})'  required></td>
				 
				 </tr>
				 <?php $sno++; } ?>
				 </tbody>
				 </table>

                

            </form>

    </div>
</div>

@stop




