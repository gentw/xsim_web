@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <section class="auto-reload-section">
        <div class="container-fluild">
            <div class="simple-shadow auto-reload-main-block">
                <div class="simple-shadow auto-reload-list">
                    <ul>
                    </ul>
                    <button id="btn-add-group" class="add-btn" type="button"><span>Add a group</span><div class="add"><img src="{{ asset('dashboard/images/add-group.png') }}" alt="add"></div></button>
                </div>
            </div>
            <div class="simple-shadow deposit-funds-block">
                <div class="current-balance">
                    <p>Current Balance</p>
                    <select id="change-group" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
                        <option value="" selected disabled>No group available</option>
                    </select>
                    <h1 id="card-balance">€0.00</h1>
                    <a href="javascript:;" id="btn-deposit" class="simple-btn round">Deposit</a>                    
                </div>
                <div class="group-card-balance">
                    <p>Manually add funds to card</p>

                    <select id="change-card" name="card_number" class="custom select2 jcf-ignore" data-error-container="#error-card-number" >
                        @forelse(Auth::user()->cards as $card)
                            <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                        @empty
                            <option value="" selected disabled>No card available</option>
                        @endforelse
                    </select>

                    <input type="number" min="0.00" step="0.01" name="group_card_balance" id="group_card_balance" class="form-control" placeholder="0.00">

                    <a href="javascript:;" id="btn-add-balance" class="simple-btn round">Submit</a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
</div>
<!-- Delete Modal -->
<div id="delete-modal" class="modal fade common-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h2>Are you sure want to delete this number?</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-confirm" data-dismiss="modal">Confirm</button>
      </div>
    </div>

  </div>
</div>
<!-- Edit Modal -->
<div id="edit-modal" class="modal fade common-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <figure class="edit-img icon"><img src="{{ asset('dashboard/images/edit.svg') }}" alt="edit" /></figure>
        <h2>Edit Group Name</h2>
        <form>
            <div class="form-group">
                <input type="text" name="name" id="group-input-edit-name" placeholder="Group Name" class="form-control">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-confirm" data-dismiss="modal">Confirm</button>
      </div>
    </div>

  </div>
</div>
<!-- Group Add Modal -->
<div id="group-add" class="modal fade common-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h2 id="group-title">Add Group &amp; Members</h2>
        <form>
            <div class="form-group">
                <input type="text" name="name" id="group-input-name" placeholder="Add Group Name" class="form-control">
            </div>
        </form>
        
        <div class="add-members">
            <ul class="list-unstyled">
            </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-confirm" data-dismiss="modal">Submit</button>
      </div>
    </div>

  </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(function(){
        var option_groups = [];
        $(document).on('click', '.group-name', function(){
            $(this).siblings('.inner-list').slideToggle(1000);
            // $('.auto-reload-main-block .inner-list').slideToggle(1000);
            $(this).toggleClass('active');
            if($(this).siblings('.inner-list').children('img').length){
                setCards($(this).siblings('.inner-list').data('group'));
            }
        });

        setGroups();

        $(document).on('click', '#btn-add-group', function(){
            var list = "";
            @foreach(Auth::user()->cards as $card)
                if($('li[id*="'+{{ $card->card_number }}+'"]').length == 0){
                    list += '<li><ul class="list-inline"><li><span>+'+"{{ $card->card_number }}"+'</span></li><li><div class="checkbox"><label><input type="checkbox" class="add-card" data-number="'+"{{ $card->card_number }}"+'"></label></div></li></ul><div class="clearfix"></div></li>';
                }
            @endforeach
            if(list == ''){
                list = '<li>No cards available.</li>';
                $('#group-add .add-members').addClass('no-cards');

            }
            $("#group-add .add-members ul").html(list);
            jcf.replace('.add-members input');
            $('#group-add #group-title').html(`Add Group &amp; Members`);
            $("#group-add").modal("show");
        });

        $(document).on('click', '.card-delete', function(){
            $("#delete-modal .btn-confirm").attr('data-id', $(this).data('id'));
            $("#delete-modal").modal("show");
        });

        $("#delete-modal").on('hide.bs.modal', function () {
            $("#delete-modal .btn-confirm").removeAttr('data-id');
        });

        $("#delete-modal .btn-confirm").click(function(){
            var id = $(this).attr('data-id');
            var group_number = id.split('_');
            manage_card('delete', group_number[0], group_number[1], 0, 0, 0, 'delete');
        });

        $(document).on('click', '.add-cards', function() {
            var group = $(this).data('group');
            var list = "";
            @foreach(Auth::user()->cards as $card)
                if($('li[id*="'+"{{ $card->card_number }}"+'"]').length == 0) {
                    list += '<li><ul class="list-inline"><li><span>+'+"{{ $card->card_number }}"+'</span></li><li><div class="checkbox"><label><input type="checkbox" class="add-card" data-number="'+"{{ $card->card_number }}"+'"></label></div></li></ul><div class="clearfix"></div></li>';
                }
            @endforeach
            if(list == ''){
                list = '<li>No cards available</li>';
                $('#group-add .add-members').addClass('no-cards');
            }            
            $("#group-add .add-members ul").html(list);
            jcf.replace('.add-members input');
            $("#group-add .btn-confirm").addClass('group-add-card').attr('data-group', group);
            $("#group-add #group-input-name").val($(this).siblings('.group-name').html()).attr('disabled', 'disabled');
            $('#group-add #group-title').html(`Add Group Members`);
            $("#group-add").modal("show");
        });

        $("#group-add").on('hide.bs.modal', function () {
            $("#group-add .btn-confirm").removeClass('group-add-card').removeAttr('data-group');
            $("#group-add #group-input-name").val('').removeAttr('disabled');
        });

        $('#group-add .btn-confirm').click(function(){
            if($(this).hasClass('group-add-card')){
                var group = $(this).attr('data-group');
                addCards(group);
            }
            else{
                addGroup();
            }
        });

        $(document).on('click', '.edit-group', function(){
            var group = $(this).data('group');
            $('#edit-modal #group-input-edit-name').val($(this).siblings('.group-name').html());
            $('#edit-modal .btn-confirm').attr('data-group', group);
            $('#edit-modal').modal("show");
        });

        $("#edit-modal").on('hide.bs.modal', function(){
            $('#edit-modal .btn-confirm').removeAttr('data-group');
        });

        $('#edit-modal .btn-confirm').click(function(){
            var group = $(this).attr('data-group');
            renameGroup(group);
        });

        $(document).on('click', '.change-rate', function(){
            var id = $(this).attr('data-id');
            var group_number = id.split('_');
            var min_rate = $("#" + id + ' .min-rate').val();
            var max_rate = $("#" + id + ' .max-rate').val();
            if(min_rate != '' && !isNaN(min_rate)){
                if(max_rate != '' && !isNaN(max_rate)){
                    if(parseFloat(min_rate) >= 0){
                        if(parseFloat(max_rate) > 0){
                            if(parseFloat(max_rate) > parseFloat(min_rate)){
                                manage_card('edit', group_number[0], group_number[1], (parseInt(max_rate) - parseInt(min_rate)), min_rate, max_rate);
                            }
                            else{
                                showMessage(412, 'Maximum amount balance must be grater than Minimum amount balance.');
                            }        
                        }
                        else{
                            showMessage(412, 'Maximum amount balance must be grater than zero.');
                        }
                    }
                    else{
                        showMessage(412, 'Minimum amount balance must be grater than or equal to zero.');
                    }
                }
                else{
                    showMessage(412, 'Please enter a valid number for maximum amount balance');    
                }
            }
            else{
                showMessage(412, 'Please enter a valid number for minimum amount balance');
            }
        });

        $(document).on('click', '.change-group-rate', function(){
            var group = $(this).data('group');
            var min_rate = $(this).siblings('.min-rate').val();
            var max_rate = $(this).siblings('.max-rate').val();
            if(min_rate != '' && !isNaN(min_rate)){
                if(max_rate != '' && !isNaN(max_rate)){
                    if(parseFloat(min_rate) >= 0){
                        if(parseFloat(max_rate) > 0){
                            if(parseFloat(max_rate) > parseFloat(min_rate)){
                                $('li[id^='+group+'_]').each(function(){
                                    var group_number = $(this).attr('id').split('_');
                                    manage_card('group_edit', group_number[0], group_number[1], (parseInt(max_rate) - parseInt(min_rate)), min_rate, max_rate);
                                });
                            }
                            else{
                                showMessage(412, 'Maximum amount balance must be grater than Minimum amount balance.');
                            }
                        }
                        else{
                            showMessage(412, 'Maximum amount balance must be grater than zero.');
                        }
                    }
                    else{
                        showMessage(412, 'Minimum amount balance must be grater than or equal to zero.');
                    }
                }
                else{
                    showMessage(412, 'Please enter a valid number for maximum amount balance');    
                }
            }
            else{
                showMessage(412, 'Please enter a valid number for minimum amount balance');
            }
        });

        function setGroups(){
            var action = "{{ route('get_corp_groups') }}";
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                beforeSend: addOverlay,
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                },
                success: function(r){
                    if(r.status == 200){
                        $('div.auto-reload-list ul').html(r.content);
                        var group_arr = [];
                        if(Array.isArray(r.group_balance)){
                            group_arr = r.group_balance;
                        }
                        for (var i = group_arr.length - 1; i >= 0; i--) {
                            option_groups.push({'group': group_arr[i].corp_remark, 'balance': group_arr[i].corp_balance, 'group_id': group_arr[i].corp_group});
                        }
                        set_options();
                    }
                    else{
                        showMessage(r.status, r.message);
                    }
                },
                complete: removeOverlay
            });
        }

        function set_options() {
            var options = "";
            for (var i = option_groups.length - 1; i >= 0; i--) {
                options += `<option value="`+option_groups[i].balance+`" data-id="`+option_groups[i].group_id+`">`+option_groups[i].group+`</option>`;
            }
            if(options != ''){
                $('#change-group').html(options);
            }
            else{
                $('#change-group').html(`<option value="" selected disabled>No group available</option>`);
            }
            jcf.refresh('#change-group');
            set_balance();
        }

        function addGroup(){
            var data = {'api_name' : 'get_group_list'};
            var group_name = $("#group-add #group-input-name").val();
            if(group_name != ""){
                call_api(data, function(r){
                    if(r.status == 200){
                        var groups = JSON.parse(r.result).group;
                        var new_group_id = parseInt(groups[groups.length-1].corp_group)+1;
                        var data = {'api_name' : 'add_group', 'corp_group' : new_group_id, 'corp_remark': group_name};
                        call_api(data, function(r) {
                            if(r.status == 200){
                                $('div.auto-reload-list ul').html($('div.auto-reload-list ul').html() +`<li>
                                                                        <div class="group-name">`+group_name+`</div>
                                                                        <a href="#" data-group="`+new_group_id+`" class="icon edit-group"><img src="{{ asset('dashboard/images/edit-big.png') }}" alt="edit" /></a>
                                                                        <input type="number" step="0.01" class="form-control min-rate" placeholder="Minimum amount balance" />
                                                                        <input type="number" step="0.01" class="form-control max-rate" placeholder="Maximum amount balance" />
                                                                        <button data-group="`+new_group_id+`" class="change-group-rate" type="submit"><img src="{{ asset('dashboard/images/right-mark.png') }}" alt="edit" /></button>
                                                                        <div class="add add-cards" data-group="`+new_group_id+`"><img src="{{ asset('dashboard/images/add-group.png') }}" alt="add"></div>
                                                                        <div class="clearfix"></div>
                                                                        <ul id="card-list-`+new_group_id+`" class="inner-list"></ul>
                                                                    </li>`);
                                update_data({'action' : 'add_group', 'group' : new_group_id, 'group_name': group_name});
                                addCards(new_group_id);
                                if($('#change-group').val() == '' || $('#change-group').val() == null){
                                    $('#change-group').html(`<option value="0.00" data-id="`+new_group_id+`">`+group_name+`</option>`);
                                }
                                else{
                                    $('#change-group').append(`<option value="0.00" data-id="`+new_group_id+`">`+group_name+`</option>`);
                                }
                                jcf.refresh('#change-group');
                                set_balance();
                            }
                            else{
                                showMessage(r.status,r.message);
                            }
                        });
                    }
                    else{
                        showMessage(r.status,r.message);
                    }
                });
            }
            else{
                showMessage(412, "The group name field is required.");
            }
        }

        $('#btn-deposit').click(function(){
            var group_id = $('#change-group option:selected').data('id');
            var group_name = $("#change-group option:selected").html();

            if(group_id != '' || group_name != ''){
                var route = "{{ route('group-deposit', [':id', ':name']) }}";
                route = route.replace(':id', group_id);
                route = route.replace(':name', group_name);
                window.location = route;
            }
            else{
                showMessage("There is no group to deposit fund.");
            }
        });

        function renameGroup(corp_group){
            if(corp_group != 0 && corp_group !== undefined){
                var group_name = $('#edit-modal #group-input-edit-name').val();
                if(group_name != ""){
                    var data = {'api_name' : 'add_group', 'corp_group' : corp_group, 'corp_remark': group_name};
                    call_api(data, function(r) {
                        if(r.status == 200){
                            $(".edit-group[data-group='"+corp_group+"']").siblings('.group-name').html(group_name);
                            showMessage(200, 'Group name successfully edited');
                            update_data({'action' : 'update_group', 'group' : corp_group, 'group_name': group_name});
                        }
                        else{
                            showMessage(r.status,r.message);
                        }
                    });
                }
                else{
                    showMessage(412, "The group name field is required.");
                }
            }
            else{
                showMessage(412, "The group name field is required.");
            }
        }

        function addCards(corp_group){
            if(corp_group != 0 && corp_group !== undefined){
                $('#group-add .add-card').each(function(){
                    if($(this).prop('checked')){
                        manage_card('add', corp_group, $(this).data('number'));
                    }
                });
            }
            else{
                showMessage(412, "Group not found");
            }
        }
        
        function manage_card(action, corp_group, card, corp_transaction, corp_minlimit, corp_maxlimit, corp_enabled){

            if(action === undefined)
                action = '';

            if(corp_group === undefined)
                corp_group = 0;

            if(card === undefined)
                card = 0;

            if(corp_transaction === undefined)
                corp_transaction = 1;

            if(corp_minlimit === undefined)
                corp_minlimit = 0;

            if(corp_maxlimit === undefined)
                corp_maxlimit = 1;

            if(corp_enabled === undefined)
                corp_enabled = 'yes';

            var data = {'api_name' : 'manage_card_to_group', 'corp_group' : corp_group, 'card' : card, 'corp_minlimit': corp_minlimit, 'corp_maxlimit': corp_maxlimit, 'corp_transaction': corp_transaction, 'corp_enabled': corp_enabled};
            call_api(data, function(r) {
                if(r.status == 200){
                    if(action == 'add'){
                        var result = JSON.parse(r.result);
                        if(result.card != undefined && result.card != null && result.card != '')
                            var card_balance = result.card.card_balance;
                        else
                            var card_balance = 'N/A';

                        update_data({'action' : 'add_card', 'group' : corp_group, 'card': card, 'corp_minlimit' : corp_minlimit, 'corp_maxlimit': corp_maxlimit, 'corp_transaction': corp_transaction });
                        if(($('#card-list-' + corp_group).html().trim()) == "<li>No cards available.</li>"){
                            $('#card-list-' + corp_group).html('');
                        }
                        $('#card-list-' + corp_group).append(`<li id="`+corp_group+`_`+card+`">
                                                                <p class="name"><span>+`+card+`</span><span class="card-balance"> &euro;`+card_balance+`</span></p>
                                                                <input type="number" step="0.01" class="form-control min-rate" value="`+(corp_minlimit == 0 ? '0.00' : corp_minlimit)+`" placeholder="Minimum amount balance" />
                                                                <input type="number" step="0.01" class="form-control max-rate" value="`+(corp_maxlimit == 0 ? '0.00' : corp_maxlimit)+`" placeholder="Maximum amount balance" />
                                                                <button data-id="`+corp_group+`_`+card+`" class="change-rate" type="submit"><img src="{{ asset('dashboard/images/right-mark.png') }}" alt="edit" /></button>
                                                                <a href="#" data-id="`+corp_group+`_`+card+`" class="icon card-delete"><img src="{{ asset('dashboard/images/rubbish-bin.png') }}" alt="rubbish bin" /></a>
                                                            </li>`);
                        showMessage(r.status, 'Card successfully added to the group');
                    }
                    else if(action == 'delete'){
                        $('#' + corp_group + '_' + card).remove();
                        update_data({'action' : 'remove_card', 'group' : corp_group, 'card': card});
                        showMessage(r.status, 'Card successfully removed from the group');
                        setCards(corp_group);
                    }
                    else if(action == 'edit'){
                        update_data({'action' : 'update_card', 'group' : corp_group, 'card': card, 'corp_minlimit' : corp_minlimit, 'corp_maxlimit': corp_maxlimit, 'corp_transaction': corp_transaction });
                        showMessage(r.status, 'Card successfully edited');
                    }
                    else if(action == 'group_edit'){
                        update_data({'action' : 'update_card', 'group' : corp_group, 'card': card, 'corp_minlimit' : corp_minlimit, 'corp_maxlimit': corp_maxlimit, 'corp_transaction': corp_transaction });
                        $("#" + corp_group + '_' + card + ' .min-rate').val(corp_minlimit);
                        $("#" + corp_group + '_' + card + ' .max-rate').val(corp_maxlimit);
                        showMessage(200, '+' + card + ' successfully edited');
                    }
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        $('#btn-add-balance').click(function(){
            if($('#change-group').val() == ''){
                showMessage(412, 'Please select a group');
                return false;
            }
            if($('#change-card').val() == ''){
                showMessage(412, 'Please select a card');
                return false;
            }
            if($('#group_card_balance').val() == '' || $('#group_card_balance').val() == 0.00 || $('#group_card_balance').val() == "0.00"){
                showMessage(412, 'Please enter a valid amount');
                return false;
            }
            add_card_balance($('#change-card').val(), $('#change-group option:selected').data('id'), $('#group_card_balance').val());
        });

        function update_data(data) {
            var action = "{{ route('add_group') }}";
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    data : data,
                },
                success: function(r){
                    // showMessage(r.status, r.message);
                }
            });
        }

        function add_card_balance(card, groupid, amount) {
            var data = {'api_name' : 'account_details'};
            call_api(data, function(r){
                if(r.status == 200){
                    var account = JSON.parse(r.result);
                    data = {'api_name' : 'add_card_balance_from_grp', 'groupid' : groupid, 'card' : card, 'amount' : amount, 'orderid' : parseInt(account.orderid)+1};
                    call_api(data, function(r){
                        if(r.status == 200){
                            showMessage(200, "Balance successfully added");
                            $.ajax({
                                url: "{{ route('add_reload_data') }}",
                                type: 'POST',
                                data: {
                                    _token: $('meta[name="csrf_token"]').attr('content'),
                                    number: card,
                                    amount: amount
                                },
                            });
                            setGroups();
                        }
                        else{
                            showMessage(r.status,r.message);
                        }
                    });
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        /**
         * Set balance on change of group
         */
        $("#change-group").change(function(){
            set_balance();
        });

        /**
         * Set balance of selected card
         */
        function set_balance(){
            $("#card-balance").html("€" + ($("#change-group").val() != '' && $("#change-group").val() != null ? $("#change-group").val() : "0.00"));
        }

        function setCards(group) {
            var action = "{{ route('get_group_cards') }}";
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    group_id : group,
                },
                success: function(r){
                    if(r.status == 200){
                        $('#card-list-' + group).html(r.data);
                    }
                }
            });
        }
    });
</script>
@endpush