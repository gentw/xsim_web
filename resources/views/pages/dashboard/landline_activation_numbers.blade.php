@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <div class="common-number-section">
            <div class="text-left">
                <select id="change-card" name="card_number" class="custom select2 jcf-ignore" >
                    @forelse(Auth::user()->cards as $card)
                        <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                    @empty
                        <option value="" selected disabled>No card available</option>
                    @endforelse
                </select>
                <span id="error-card-number"></span>
            </div>
        </div>
    <div class="landline-activation-section numbers-list">
            <div class="text-center">
                <h1>Your Current National Numbers</h1>
                <ul>
                </ul>
                <a href="{{ route('dashboard.landline_activation') }}" class="btn simple-btn yellow">Add a new number</a>
            </div>
    </div>

</div>
@endsection

@push('page_js')
<script src="{{ asset('admin/plugins/bootbox/bootbox.min.js') }}" type="text/javascript"></script>
@endpush

@push('scripts')
<script type="text/javascript">
    $(function(){

        /**
         * Set balance and history of selected card
         */
        if($("#change-card").val() != '' && $("#change-card").val() != null){
            var card_selected = "{{ session('card_selected') }}";
            if(card_selected != '' && card_selected != null){
                if(card_selected != $("#change-card").val()){
                    $("#change-card").val(card_selected).change();
                }
            }
            else{
                $.ajax({
                    url: "{{ route('set_session_card') }}",
                    type: 'POST',
                    data: { _token: $('meta[name="csrf_token"]').attr('content'), card: $("#change-card").val() }
                });
            }
            set_national_numbers($("#change-card").val());
        }

        /**
         * Set balance and history on change of card
         */
        $("#change-card").change(function(){
            var card_selected = "{{ session('card_selected') }}";
            if(card_selected != $("#change-card").val()){
                $.ajax({
                    url: "{{ route('set_session_card') }}",
                    type: 'POST',
                    data: { _token: $('meta[name="csrf_token"]').attr('content'), card: $("#change-card").val() }
                });
            }
            set_national_numbers($(this).val());
            // set_call_history($(this).val(), '2017-05-01', '2018-02-18');
        });


        /**
         * Set balance of selected card
         */
        function set_national_numbers(card){
            var numbers = [];
            var data = {'api_name' : 'get_all_enum', 'num': card};
            call_api(data, function(r){
                if(r.status == 200){
                    var card = JSON.parse(r.result);
                    if(Array.isArray(card.primary_enum)){
                        if(card.primary_enum.length > 0){
                            for (var i = card.primary_enum.length - 1; i >= 0; i--) {
                                if(card.primary_enum[i] != undefined && card.primary_enum[i] != '' && card.primary_enum[i] != null){
                                    numbers.push({card : card.primary_enum[i], type: 'primary'});
                                }
                            }
                        }
                    }
                    else{
                        if(card.primary_enum != '' || card.primary_enum != null || card.primary_enum != undefined){ 
                            numbers.push({card : card.primary_enum, type: 'primary'});    
                        }
                    }
                    if(Array.isArray(card.secondary_enum) && card.secondary_enum.length > 0){
                        for (var i = card.secondary_enum.length - 1; i >= 0; i--) {
                            if(card.secondary_enum[i] != undefined && card.secondary_enum[i] != '' && card.secondary_enum[i] != null){
                                numbers.push({card : card.secondary_enum[i], type: 'secondary'});
                            }
                        }
                    }
                    else{
                        if(card.secondary_enum != '' || card.secondary_enum != null){
                            if(card.secondary_enum != undefined && card.secondary_enum != '' && card.secondary_enum != null){
                                numbers.push({card : card.secondary_enum, type: 'secondary'});
                            }
                        }
                    }
                    
                    $('.numbers-list ul').html('');
                    for (var i = numbers.length - 1; i >= 0; i--) {
                        $('.numbers-list ul').append(`<li><span>+`+numbers[i].card+`</span><a href="javascript:;" class="remove_enum" data-number="`+numbers[i].card+`" data-type="`+numbers[i].type+`"> <i class="fa fa-trash"></i> </a><div class="clearfix"></div></li>`);
                    }
                }
                else{
                    $('.numbers-list ul').html(`<li>There is no numbers seted.</li>`);   
                }
            });
        }

        $(document).on('click', '.remove_enum', function(){
            var type = $(this).data('type');
            var number = $(this).data('number');
            bootbox.confirm('Are you sure! you want to delete this number?', function(res){
                if(res){
                    if(type == 'primary'){
                        remove_primary_national_number($('#change-card').val(), number);
                    }
                    else{
                        remove_secondary_national_number($('#change-card').val(), number);
                    }
                }
            });
        });

        function remove_primary_national_number(card, number) {
            var data = {'api_name' : 'add_national_number', 'card' : card, 'enum' : ''};
            call_api(data, function(r){
                if(r.status == 200){
                    change_enum_status(number);
                    set_national_numbers(card);
                    showMessage(r.status, "National Number successfully removed from your card.");
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        function remove_secondary_national_number(card, number) {
            var data = {'api_name' : 'remove_national_number', 'card' : card, 'enum' : number};
            call_api(data, function(r){
                if(r.status == 200){
                    change_enum_status(number);
                    set_national_numbers(card);
                    showMessage(r.status, "National Number successfully removed from your card.");
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        function change_enum_status(number) {
            $.ajax({
                url: "{{ route('change_number_status') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    number: number,
                },
            });
        }
    });
</script>
@endpush