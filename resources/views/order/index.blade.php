<!-- Extends template page-->
@extends('layout.app')

<!-- Specify content -->
@section('content')

<h3>Order List</h3>
   
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">

        <!-- Alert message (start) -->
        @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class') }}">
            {{ Session::get('message') }}
        </div>
        @endif
        <!-- Alert message (end) -->
           
        <div class='actionbutton'>
                        
            <a class='btn btn-info float-right' href="{{route('order.create')}}">Add</a>
                        
        </div>
        <table class="table" >
            <thead>
                <tr>
                    <th width='40%'>Order Id</th>
                    <th width='40%'>Date</th>
                    <th width='20%'>Customer Name</th>
					<th width='20%'>Customer no</th>
                </tr>
            </thead>
            <tbody>
            @foreach($order as $row)
                <tr>
                    <td>{{ $row->order_no }}</td>
                    <td>{{ $row->order_date }}</td>
					<td>{{ $row->customer_name }}</td>
					<td>{{ $row->customer_no }}</td>
                    <td>
                        <!-- Edit -->
                        <a href="{{ route('order.edit',[$row->id]) }}" class="btn btn-sm btn-info">Edit</a>
                        <!-- Delete -->
						 <a href="{{ route('order.view',[$row->id]) }}" class="btn btn-sm btn-info">View</a>
						  <a href="{{ route('order.json',[$row->id]) }}" class="btn btn-sm btn-info">json</a>
						 <!--
                        <a href="{{ route('order.delete',$row->id) }}" class="btn btn-sm btn-danger">Delete</a>
						
						-->
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
            
    </div>
</div>
@stop
