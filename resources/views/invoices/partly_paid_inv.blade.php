@extends('layouts.master')
@section('title')
    الفواتير المدفوعة جزئيا
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">    الفواتير المدفوعة جزئيا
                </h4>

            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

@if (session()->has('delete_invoice'));
    <script>
        window.onload=function(){
            notif({
                msg:'تم حذف الفاتورة بنجاح ',
                type:'success'
            })
        }
    </script>
@endif
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                        <div class="col-sm-6 col-md-3">
                            <a href="invoices/create"class="btn btn-primary-gradient btn-block" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                        </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ القاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">الخصم</th>
                                <th class="border-bottom-0">نسبة الضريبة</th>
                                <th class="border-bottom-0">قيمة الضريبة</th>
                                <th class="border-bottom-0">الاجمالي</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">ملاحظات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=1;?>
                            @foreach($invoices as $invoice)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="{{route('invd',$invoice->id)}}"> {{$invoice->invoice_number}}  </a></td>
                                    <td>{{$invoice->invoice_Date}}</td>
                                    <td>{{$invoice->Due_date}}</td>
                                    <td>{{$invoice->product}}</td>
                                    <td> {{$invoice->sections->section_name}}</td>
                                    <td>{{$invoice->Discount}}</td>
                                    <td>{{$invoice->Rate_VAT}}</td>
                                    <td>{{$invoice->Value_VAT}}</td>
                                    <td>{{$invoice->Total}}</td>
                                    <td>
                                        @if ($invoice->Value_Status == 1)
                                            <span class="text-success">{{ $invoice->Status }}</span>
                                        @elseif($invoice->Value_Status == 2)
                                            <span class="text-danger">{{ $invoice->Status }}</span>
                                        @else
                                            <span class="text-warning">{{ $invoice->Status }}</span>
                                        @endif

                                    </td>
                                    <td>{{$invoice->note}}</td>


                                </tr>
                            @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->

@endsection

@section('js')
                    <!-- Internal Data tables -->
                    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
                    <!--Internal  Datatable js -->
                    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
                    <!--Internal  Notify js -->
                    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
                    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
