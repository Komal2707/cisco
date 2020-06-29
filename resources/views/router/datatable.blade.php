@extends('layouts.master')

@section('content')
    <div>
        <div class="box">
            <div class="box-header">
                <div class="row">
                    <div class="col-md-12">
                        {{-- @can('packing pre customer order' ) --}}
                        <a class="btn btn-success margin pull-right" href="{{route("admin::cisco::router::create")}}"><span
                            class="glyphicon glyphicon-plus"></span> Create New Router</a>
                        {{-- @endcan --}}
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                {!! $builder->table(['style' => 'width:100%'], true) !!}
            </div>
        </div>
    </div>

    <div class="modal fade" id="quote" tabindex="-1">
        <div class="modal-dialog" style="width: 70%">
            <div class="modal-content" id="quote_body">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    @component('layouts.smonk.partials.confirm-danger-pop',['title' => "Warning !" , 'message'=> 'Are you sure want to confirm this order?'])
        @slot('callBack')
            window.LaravelDataTables["dataTableBuilder"].draw('page');
        @endslot
    @endcomponent

@endsection


@push('scripts')
    <script type="text/javascript">

        function loadQuote(url) {
            window.app.inprocess = true;
            $("#quote_body").load(url, function () {
                $('#quote').modal({show: true});
                window.app.inprocess = false;
            });
        }

    </script>
    {!! $builder->scripts() !!}
@endpush

@section('head_css')
<style type="text/css">
    .message-clr span {
        margin: 5px;

    }
</style>

@endsection